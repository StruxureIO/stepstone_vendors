<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%vendors}}`.
 */
class m211019_185453_add_areas_columns_to_vendors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vendors}}', 'areas', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vendors}}', 'areas');
    }
}
