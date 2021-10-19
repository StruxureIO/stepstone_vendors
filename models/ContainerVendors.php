<?php

namespace humhub\modules\stepstone_vendors\models;

use humhub\modules\stepstone_vendors\widgets\VendorsWidget;
use humhub\modules\search\interfaces\Searchable;
//use humhub\modules\search\events\SearchAddEvent; //used in some cases
use Yii;
use humhub\modules\stepstone_vendors\activities;
use humhub\modules\content\models\Content;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\user\behaviors\Followable;
use humhub\modules\content\components\behaviors\SettingsBehavior;
use humhub\modules\content\components\behaviors\CompatModuleManager;

/**
 * This is the model class for table "vendors".
 *
 * @property int $id
 * @property string $vendor_name
 * @property int $vendor_type
 * @property string|null $vendor_contact
 * @property string|null $vendor_phone
 * @property string|null $vendor_email
 * @property int|null $vendor_recommended_user_id
 * @property int|null $vendor_rating
 */
class ContainerVendors extends ContentActiveRecord implements Searchable
{
      
    protected $moduleId = 'vendors';

    public $id = 'vendors';
    
    public $name = 'Vendors';
  
    //public $autoFollow = false;

    protected $streamChannel = 'default';

    //public $silentContentCreation = true;
    
    //public $wallEntryClass = "humhub\modules\stepstone_vendors\widgets\VendorsWall";
    
    public $autoAddToWall = true;
    
    public $wallEntryClass = "humhub\modules\stepstone_vendors\widgets\VendorsWall";

    //public $wallEntryClass = VendorsWall::class;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendors';
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
        return $this->getTitle();
    }
        
//    public function behaviors()
//    {
//        return [
//            [
//                'class' => PolymorphicRelation::class,
//                'strict' => true,
//                'mustBeInstanceOf' => [
//                    ActiveRecord::class,
//                ]
//            ]
//        ];
//    }
    
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
    public function rules()
    {
        return [
            [['vendor_name', 'vendor_type'], 'required'],
            [['vendor_type', 'vendor_recommended_user_id', 'vendor_rating'], 'integer'],
            [['vendor_name'], 'string', 'max' => 100],
            [['vendor_contact', 'vendor_email'], 'string', 'max' => 60],
            [['vendor_phone'], 'string', 'max' => 30],
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
        ];
    }
    
    public function getVendorTypesRecords()
    {
        return $this->hasOne(VendorTypes::class(), ['vendor_type' => 'type_id']);
    }    
    
    public function getWallOut($params = []) {
      
      return VendorsWall::widget(['vendors' => $this]);
      
    }
                
    public function vendorAdded() {
      
      $activity = new \humhub\modules\stepstone_vendors\activities\NewVendor();
      $activity->source = $this;
      $activity->originator = Yii::$app->user->getIdentity();
      $activity->create();            
    }
    
    public function getTitle(){
      return $this->vendor_name;
    }
    
    public function handleContentSave($evt, $content = null)
    {
        /* @var $content Content */
        $content = ($content) ? $content : $evt->sender;
        if($evt->sender->container instanceof User && $evt->sender->isPrivate()) {
            $evt->sender->visibility = Content::VISIBILITY_OWNER;
        }

        return true;
    }
    
    public function getEditUrl()
    {
        return Url::toEditPage($this->id, $this->content->container);
    }
    
        
    
}
