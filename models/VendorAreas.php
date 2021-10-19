<?php

namespace humhub\modules\stepstone_vendors\models;

use Yii;

/**
 * This is the model class for table "vendor_areas".
 *
 * @property int $area_id
 * @property string $area_name
 */
class VendorAreas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_areas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['area_name'], 'required'],
            [['area_name'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'area_id' => 'Area ID',
            'area_name' => 'Area Name',
        ];
    }
}
