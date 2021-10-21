<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%vendor_types}}`.
 */
class m211019_202638_add_icon_column_to_vendor_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vendor_types}}', 'icon', $this->string(40));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vendor_types}}', 'icon');
    }
}
