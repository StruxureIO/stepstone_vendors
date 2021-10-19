<?php

namespace humhub\modules\stepstone_vendors\models;

use Yii;

/**
 * This is the model class for table "vendor_area_list".
 *
 * @property int $list_id
 * @property int $vendor_id
 * @property int $area_id
 */
class VendorAreaList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_area_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_id', 'area_id'], 'required'],
            [['vendor_id', 'area_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'list_id' => 'List ID',
            'vendor_id' => 'Vendor ID',
            'area_id' => 'Area ID',
        ];
    }
}
