<?php

namespace humhub\modules\stepstone_vendors\models;

use Yii;

/**
 * This is the model class for table "vendor_types".
 *
 * @property int $type_id
 * @property string $type_name
 * @property string icon
 */
class VendorTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name'], 'required'],
            [['type_name'], 'string', 'max' => 60],
            [['icon'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'type_name' => 'Type Name',
            'icon' => 'Icon',
        ];
    }
    
}
