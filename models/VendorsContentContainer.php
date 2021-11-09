<?php

namespace humhub\modules\stepstone_vendors\models;

use humhub\modules\post\models\Post;
use humhub\modules\space\models\Membership;

use humhub\modules\stepstone_vendors\notifications\VendorAdded;
use humhub\modules\stepstone_vendors\permissions\CreateVendors;
use humhub\modules\stepstone_vendors\permissions\ManageVendors;
use humhub\modules\content\models\Content;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\user\components\ActiveQueryUser;
use humhub\modules\vendors\activities;
use humhub\modules\search\interfaces\Searchable;
use humhub\modules\search\events\SearchAddEvent;
use humhub\modules\content\components\behaviors\SettingsBehavior;
use humhub\components\behaviors\PolymorphicRelation;
use humhub\modules\stepstone_vendors\widgets\WallEntry;

//use humhub\modules\search\events\SearchAddEvent; //used in some cases
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\stepstone_vendors\models\VendorTypes;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use humhub\modules\content\helpers\ContentContainerHelper;

//use humhub\modules\content\widgets\richtext\RichText;
//use humhub\modules\content\components\behaviors\CompatModuleManager;
//use LogicException;


/**
 * This is the model class for table "vendors".
 *
 * @property int $id
 * @property string $vendor_name
 * @property int $vendor_type
 * @property int $subtype
 * @property string|null $vendor_contact
 * @property string|null $vendor_phone
 * @property string|null $vendor_email
 * @property int|null $vendor_recommended_user_id
 * @property int|null $vendor_rating
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property string|null $areas
*/
//abstract
class VendorsContentContainer extends ContentActiveRecord implements Searchable
{

    const VISIBILITY_ADMIN_ONLY = 3;
    const VISIBILITY_PRIVATE = 0;
    const VISIBILITY_PUBLIC = 1;

    /**
     * @var bool field only used in edit form
     */
    public $visibility = VendorsContentContainer::VISIBILITY_PUBLIC;

    protected $moduleId = 'stepstone_vendors';

    //public $id = 2;

    //public $name = 'Vendors';

    //public $autoFollow = false;

    protected $streamChannel = 'default';

    public $canMove = true;

    public $wallEntryClass = "humhub\modules\stepstone_vendors\widgets\WallEntry";

    public static function tableName()
    {
        return 'vendors';
    }

    public function rules()
    {
        return [
            [['vendor_name', 'vendor_type', 'subtype', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['vendor_type', 'subtype', 'vendor_recommended_user_id', 'vendor_rating', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['vendor_name'], 'string', 'max' => 100],
            [['vendor_contact', 'vendor_email'], 'string', 'max' => 60],
            [['vendor_phone'], 'string', 'max' => 30],
            [['areas'], 'string'],            
       ];
    }

    public function behaviors()
    {
        return [
            'acl' => [
                'class' => \humhub\components\behaviors\AccessControl::class,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Vendor ID',
            'vendor_name' => 'Vendor Name',
            'vendor_type' => 'Vendor Type',
            'vendor_contact' => 'Vendor Contact',
            'vendor_phone' => 'Vendor Phone',
            'vendor_email' => 'Vendor Email',
            'vendor_recommended_user_id' => 'Vendor Recommended User ID',
            'vendor_rating' => 'Vendor Rating',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'areas' => 'Areas',
       ];
    }

    public function getVendorTypesRecords()
    {
        return $this->hasOne(VendorTypes::class, ['vendor_type' => 'type_id']);
    }

    public function getContentName()
    {
        return Yii::t('StepstoneVendorsModule.base', "Vendor");
    }

    /**
     * @inheritdoc
     */
    public function getContentDescription()
    {
        return $this->vendor_name;
    }

    public function getUrl()
    {
        return Url::base() . "/index.php?r=stepstone_vendors%2Fvendors&cguid=" . $this->content->container->guid;
    }

//    public function getContentType()
//    {
//        return ContentType::getById($this->type);
//    }


    public function getTitle()
    {
        return $this->vendor_name;
    }

    public function getIcon()
    {
        if ($this->hasAttribute('icon') && $this->icon) {
            return $this->icon;
        }

        return null;
    }

//    public function beforeSave($insert)
//    {
//        $this->content->visibility = Content::VISIBILITY_PUBLIC;
//
//        $this->streamChannel = 'default';
//
//        return parent::beforeSave($insert);
//    }

    public function afterSave($insert, $changedAttributes)
    {
        
        if($this->content->contentcontainer_id != null) {
                   
          $users = $this->findSpaceMembers($this->content->contentcontainer_id);

          //Sending notification
          if (!empty($users)) {
              $notification = VendorAdded::instance()
                  ->from($this->createdBy)
                  ->about($this);
              $notification->sendBulk($users);
          }
        }

        $this->vendorAdded();
        parent::afterSave($insert, $changedAttributes);

    }

    /**
     * @param $spaceContainerId integer the space content container id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findSpaceMembers(int $spaceContainerId)
    {
        $space = Space::find()
            ->where(['contentcontainer_id' => $spaceContainerId])
            ->one();
        $members = Membership::find()
            ->where(['space_id' => $space->id])
            ->asArray()
            ->all();
        $usersIds = array_map(function ($member) {
            return $member['user_id'];
        }, $members);
        return User::find()
            ->where(['in', 'id', $usersIds])
            ->all();
    }

    public function getWallOut($params = array())
    {

        return WallEntry::widget(['vendors' => $this]);

    }

    public function getSearchAttributes()
    {

        $attributes['name'] = $this->vendor_name;

        if (!empty($this->vendor_contact))
            $attributes['contact'] = $this->vendor_contact;

        if (!empty($this->vendor_phone))
            $attributes['phone'] = $this->vendor_phone;

        if (!empty($this->vendor_email))
            $attributes['email'] = $this->vendor_email;

        $this->trigger(self::EVENT_SEARCH_ADD, new SearchAddEvent($attributes));

        return $attributes;

    }

//    public function getSearchAttributes()
//    {
//        $attributes = [
//            'description' => $this->description
//        ];
//
//        if($this->getCreator()) {
//            $attributes['creator'] = $this->getCreator()->getDisplayName();
//        }
//
//        if($this->getEditor()) {
//            $attributes['editor'] = $this->getEditor()->getDisplayName();
//        }
//
//        if ($this->baseFile) {
//            $attributes['name'] = $this->getTitle();
//        }
//        $this->trigger(self::EVENT_SEARCH_ADD, new SearchAddEvent($attributes));
//        return $attributes;
//    }


    public function vendorAdded()
    {

        $activity = new \humhub\modules\stepstone_vendors\activities\NewVendor();
        $activity->source = $this;
        $activity->originator = Yii::$app->user->getIdentity();
        $activity->create();

    }

//    public function handleContentSave($evt, $content = null)
//    {
//        /* @var $content Content */
//        $content = ($content) ? $content : $evt->sender;
//        if($evt->sender->container instanceof User && $evt->sender->isPrivate()) {
//            $evt->sender->visibility = Content::VISIBILITY_OWNER;
//        }
//
//        return true;
//    }


}
