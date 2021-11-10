<?php

use yii\db\Migration;

/**
 * Class m211105_150329_create_vendors_comments
 */
class m211105_150329_create_vendors_comments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('vendor_comments', [
            'id' => $this->primaryKey(),
            'vendor_id' => 'int(11) DEFAULT NULL',
            'message' => 'text DEFAULT NULL',
            'original_message' => 'text DEFAULT NULL',
            'url' => 'varchar(255) DEFAULT NULL',
            'created_at' => 'datetime DEFAULT NULL',
            'created_by' => 'bigint(20) DEFAULT NULL',
            'updated_at' => 'datetime DEFAULT NULL',
            'updated_by' => 'int(11) DEFAULT NULL',
        ], '');
        $this->createIndex('idx-vendor_comments-vendor_id', '{{%vendor_comments}}', 'vendor_id');
//        $this->addForeignKey('fk-vendor_comments-vendors', '{{%vendor_comments}}', 'vendor_id', '{{%vendors}}', 'id', 'SET NULL', 'RESTRICT');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vendor_comments}}');
    }

  }
