<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%vendor_sub_type}}`.
 */
class m211019_202721_add_icon_column_to_vendor_sub_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vendor_sub_type}}', 'icon', $this->string(40));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vendor_sub_type}}', 'icon');
    }
}
