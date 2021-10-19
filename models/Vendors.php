<?php

namespace humhub\modules\stepstone_vendors\models;
use humhub\modules\stepstone_vendors\widgets\VendorsWidget;
//use humhub\modules\search\interfaces\Searchable;
//use humhub\modules\search\events\SearchAddEvent; //used in some cases
use Yii;
//use humhub\humhub\modules\stepstone_vendors\activities;
//use humhub\components\behaviors\PolymorphicRelation;

//include "protected/modules/stepstone_vendors/activities/NewVendor.php";

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
//class Vendors extends \yii\db\ActiveRecord
//class Vendors extends ContentActiveRecord implements Searchable
class Vendors extends \yii\db\ActiveRecord
{
  
    //public $wallEntryClass = "humhub\modules\\vendors\widgets\VendorsWall";
    //public $wallEntryClass = VendorsWall::class;
    //public $wallEntryClass = "humhub\modules\onlinedrives\widgets\WallEntryFile";
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendors';
    }

    /**
     * {@inheritdoc}
     */
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
        return $this->hasOne(VendorTypes::class(), ['vendor_type' => 'type_id']);
    }    
    
    public function getWallOut() {
      
      return VendorsWall::widget(['vendors' => $this]);
      
    }
        
    public function vendorAdded() {
      
      $activity = new \humhub\modules\stepstone_vendors\activities\NewVendor();
      $activity->source = $this;
      $activity->originator = Yii::$app->user->getIdentity();
      $activity->create();
            
    }
    
}
