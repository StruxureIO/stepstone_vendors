<?php

use yii\db\Migration;

/**
 * Class m211026_180654_update_icon_column_to_vendor_subtype_table
 */
  class m211026_180654_update_icon_column_to_vendor_subtype_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      //fas fa-pencil-ruler
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-pencil-ruler'], ['subtype_id' => 1]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'far fa-building'], ['subtype_id' => 2 ]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-truck-moving'], ['subtype_id' => 3]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-user-hard-hat'], ['subtype_id' => 5]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-fan'], ['subtype_id' => 6]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-lightbulb-on'], ['subtype_id' => 7]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fad fa-hammer'], ['subtype_id' => 8]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-toilet'], ['subtype_id' => 9]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-dumpster'], ['subtype_id' => 10]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-cubes'], ['subtype_id' => 11]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-house-leave'], ['subtype_id' => 12]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-cloud-sun-rain'], ['subtype_id' => 13]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-store-alt'], ['subtype_id' => 14]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-cube'], ['subtype_id' => 15]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-brush'], ['subtype_id' => 16]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-paint-roller'], ['subtype_id' => 17]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-hand-holding-seedling'], ['subtype_id' => 18]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-house-leave'], ['subtype_id' => 19]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-cabinet-filing'], ['subtype_id' => 20]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-door-open'], ['subtype_id' => 21]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-tree'], ['subtype_id' => 22]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-debug'], ['subtype_id' => 23]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-user-lock'], ['subtype_id' => 24]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-border-style'], ['subtype_id' => 25]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-people-carry'], ['subtype_id' => 26]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-cogs'], ['subtype_id' => 27]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-cogs'], ['subtype_id' => 28]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-file-certificate'], ['subtype_id' => 29]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-file-contract'], ['subtype_id' => 30]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-file-certificate'], ['subtype_id' => 31]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'far fa-handshake'], ['subtype_id' => 32]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-clipboard-list' ], ['subtype_id' => 33]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-laptop-house' ], ['subtype_id' => 34]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-money-check-alt' ], ['subtype_id' => 35]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'far fa-money-bill-alt' ], ['subtype_id' => 36]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-coin' ], ['subtype_id' => 37]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-usd-square' ], ['subtype_id' => 38]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'far fa-newspaper' ], ['subtype_id' => 39]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fa-sign' ], ['subtype_id' => 40]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-bullseye-pointer' ], ['subtype_id' => 41]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-camera' ], ['subtype_id' => 42]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-bullseye' ], ['subtype_id' => 43]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-hand-holding-usd' ], ['subtype_id' => 44]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-house-damage' ], ['subtype_id' => 45]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fad fa-books' ], ['subtype_id' => 46]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-abacus' ], ['subtype_id' => 47]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-envelope-open-dollar' ], ['subtype_id' => 48]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-university' ], ['subtype_id' => 49]);
        $this->update('{{%vendor_sub_type}}', ['icon' => 'fas fa-file-invoice-dollar' ], ['subtype_id' => 50]);
        
        $this->update('{{%vendor_types}}', ['icon' => 'far fa-sack-dollar' ], ['type_id' => 2]);
        $this->update('{{%vendor_types}}', ['icon' => 'fas fa-user-hard-hat' ], ['type_id' => 3]);
        $this->update('{{%vendor_types}}', ['icon' => 'fas fa-gavel' ], ['type_id' => 4]);
        $this->update('{{%vendor_types}}', ['icon' => 'fas fa-file-signature' ], ['type_id' => 5]);
        $this->update('{{%vendor_types}}', ['icon' => 'fas fa-user-hard-hat' ], ['type_id' => 6]);
        $this->update('{{%vendor_types}}', ['icon' => 'fas fa-megaphone' ], ['type_id' => 7]);
        $this->update('{{%vendor_types}}', ['icon' => 'fas fa-coins' ], ['type_id' => 8]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211026_180654_update_icon_column_to_vendor_subtype_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211026_180654_update_icon_column_to_vendor_subtype_table cannot be reverted.\n";

        return false;
    }
    */
}
