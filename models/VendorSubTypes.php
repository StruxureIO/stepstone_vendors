<?php

namespace humhub\modules\stepstone_vendors\models;

use Yii;

/**
 * This is the model class for table "vendor_sub_type".
 *
 * @property int $subtype_id
 * @property int $type_id
 * @property string $subtype_name
 * @property string icon
*/
class VendorSubTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_sub_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'subtype_name'], 'required'],
            [['subtype_id', 'type_id'], 'integer'],
            [['subtype_name'], 'string', 'max' => 60],
            [['icon'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subtype_id' => 'Subtype ID',
            'type_id' => 'Type ID',
            'subtype_name' => 'Subtype Name',
            'icon' => 'Icon',
        ];
    }
}
