<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vendor_area_list}}`.
 */
class m211015_200657_create_vendor_area_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vendor_area_list}}', [
            'list_id' => $this->primaryKey(),
            'vendor_id' => $this->integer(),
            'area_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vendor_area_list}}');
    }
}
