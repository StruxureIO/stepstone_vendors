<?php

namespace humhub\modules\stepstone_vendors\models;

use Yii;

/**
 * This is the model class for table "vendors_ratings".
 *
 * @property int $rating_id
 * @property int $vendor_id
 * @property int $user_id
 * @property int $user_rating
 */
class VendorsRatings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendors_ratings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_id', 'user_id', 'user_rating'], 'required'],
            [['vendor_id', 'user_id', 'user_rating'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rating_id' => 'Rating ID',
            'vendor_id' => 'Vendor ID',
            'user_id' => 'User ID',
            'user_rating' => 'User Rating',
        ];
    }
}
