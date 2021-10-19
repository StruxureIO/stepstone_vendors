<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vendor_areas}}`.
 */
class m211015_195052_create_vendor_areas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vendor_areas}}', [
            'area_id' => $this->primaryKey(),
            'area_name' => $this->string(60)->notNull(),
        ]);
        
        $this->insert('vendor_areas', [
            'area_id' => 1,
            'tag_name' => 'Texas',
        ]);      
        
        $this->insert('vendor_areas', [
            'area_id' => 2,
            'tag_name' => 'Dallas/Fort Worth',
        ]);      
        
        $this->insert('vendor_areas', [
            'area_id' => 3,
            'tag_name' => 'Austin',
        ]);      
        
        $this->insert('vendor_areas', [
            'area_id' => 4,
            'tag_name' => 'San Antonio',
        ]);      
        
        $this->insert('vendor_areas', [
            'area_id' => 5,
            'tag_name' => 'Houston',
        ]);      
        
        
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vendor_areas}}');
    }
}
