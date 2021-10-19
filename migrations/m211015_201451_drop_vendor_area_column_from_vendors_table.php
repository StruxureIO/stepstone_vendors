<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%vendors}}`.
 */
class m211015_201451_drop_vendor_area_column_from_vendors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%vendors}}', 'vendor_area');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%vendors}}', 'vendor_area', $this->string());
    }
}
