<?php

namespace humhub\modules\stepstone_vendors\models;

use humhub\modules\content\widgets\richtext\RichText;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\vendors\activities;
use humhub\modules\search\interfaces\Searchable;
use humhub\modules\user\models\User;
use Yii;



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
class VendorComments extends ContentActiveRecord implements Searchable
{

    const VISIBILITY_ADMIN_ONLY = 3;
    const VISIBILITY_PRIVATE = 0;
    const VISIBILITY_PUBLIC = 1;

    /**
     * @var bool field only used in edit form
     */
    public $visibility = VendorComments::VISIBILITY_PUBLIC;

    protected $moduleId = 'stepstone_vendors';

    protected $streamChannel = 'default';

    public $canMove = true;

    public $wallEntryClass = "humhub\modules\stepstone_vendors\widgets\VendorCommentsWallEntry";

    public static function tableName(): string
    {
        return 'vendor_comments';
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'vendor_id'], 'required'],
            [['message'], 'string'],
            [['vendor_id'], 'integer'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        // Check if Post Contains an Url
        if (preg_match('/http(.*?)(\s|$)/i', $this->message)) {
            // Set Filter Flag
            $this->url = 1;
        }

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        RichText::postProcess($this->message, $this, 'message');
    }

    /**
     * @inheritdoc
     */
    public function getContentName()
    {
        return Yii::t('StepstoneVendorsModule.base', 'vendor comments');
    }

    /**
     * @inheritdoc
     */
    public function getLabels($result = [], $includeContentName = true)
    {
        return parent::getLabels($result, false);
    }

    /**
     * @inheritdoc
     */
    public function getIcon()
    {
        return 'fa-comment';
    }

    /**
     * @inheritdoc
     */
    public function getContentDescription()
    {
        return $this->message;
    }

    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {
        $attributes = [
            'message' => $this->message,
            'url' => $this->url,
            'user' => $this->getPostAuthorName()
        ];

        $this->trigger(self::EVENT_SEARCH_ADD, new \humhub\modules\search\events\SearchAddEvent($attributes));

        return $attributes;
    }

    /**
     * @return string
     */
    private function getPostAuthorName()
    {
        $user = User::findOne(['id' => $this->created_by]);

        if ($user !== null && $user->isActive()) {
            return $user->getDisplayName();
        }

        return '';
    }


}
