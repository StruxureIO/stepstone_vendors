<?php

use yii\db\Migration;

/**
 * Class m210908_153454_vendors_inital
 */
class m210908_153454_vendors_inital extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
      
      $this->createTable('vendors', [
        'id' => 'pk',
        'vendor_name' => 'varchar(100) NOT NULL',
        'vendor_type' => 'tinyint(4) NOT NULL',
        'subtype' => 'tinyint(4) NULL',
        'vendor_contact' => 'varchar(60) DEFAULT NULL',
        'vendor_phone' => 'varchar(30) DEFAULT NULL',
        'vendor_email' => 'varchar(60) DEFAULT NULL',
        'vendor_area' => 'varchar(60) DEFAULT NULL',
        'vendor_recommended_user_id' => 'int(11) DEFAULT NULL',
        'vendor_rating' => 'tinyint(4) DEFAULT NULL',
        'created_at' => 'datetime DEFAULT NULL',
        'created_by' => 'int(11) DEFAULT NULL',
        'updated_at' => 'datetime DEFAULT NULL',
        'updated_by' => 'int(11) DEFAULT NULL',
      ], '');

      $this->createTable('vendor_types', [
        'type_id' => 'pk',
        'type_name' => 'varchar(60) NOT NULL',
      ], '');

      $this->createTable('vendors_ratings', [
        'rating_id' => 'pk',
        'vendor_id' => 'int(11) NOT NULL',
        'user_id' => 'int(11) NOT NULL',
        'user_rating' => 'tinyint(4) NOT NULL',
        'rating_date' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        'review' => 'text',
      ], '');

      $this->createTable('vendor_sub_type', [
        'subtype_id' => 'pk',
        'type_id' => 'int(11) NOT NULL',
        'subtype_name' => 'varchar(60) CHARACTER SET utf8 NOT NULL',
      ], '');


      $this->insert('vendor_types', [
          'type_id' => '2',
          'type_name' => 'Lenders',
      ]);

      $this->insert('vendor_types', [
          'type_id' => '3',
          'type_name' => 'Contractors',
      ]);

      $this->insert('vendor_types', [
          'type_id' => '4',
          'type_name' => 'Attorneys',
      ]);

      $this->insert('vendor_types', [
          'type_id' => '5',
          'type_name' => 'Closing Services',
      ]);

      $this->insert('vendor_types', [
          'type_id' => '6',
          'type_name' => 'Home Design',
      ]);

      $this->insert('vendor_types', [
          'type_id' => '7',
          'type_name' => 'Marketing',
      ]);

      $this->insert('vendor_types', [
          'type_id' => '8',
          'type_name' => 'Financial Services',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '1',
          'type_id' => '6',
          'subtype_name' => 'Designers',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '2',
          'type_id' => '6',
          'subtype_name' => 'Architects',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '3',
          'type_id' => '6',
          'subtype_name' => 'Stagers',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '5',
          'type_id' => '3',
          'subtype_name' => 'General Contractors',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '6',
          'type_id' => '3',
          'subtype_name' => 'AC',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '7',
          'type_id' => '3',
          'subtype_name' => 'Electricians',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '8',
          'type_id' => '3',
          'subtype_name' => 'Carpentry and Trim',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '9',
          'type_id' => '3',
          'subtype_name' => 'Plumbers',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '10',
          'type_id' => '3',
          'subtype_name' => 'Septic',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '11',
          'type_id' => '3',
          'subtype_name' => 'Make-Ready Services',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '12',
          'type_id' => '3',
          'subtype_name' => 'Handyman Services',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '13',
          'type_id' => '3',
          'subtype_name' => 'Roofers',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '14',
          'type_id' => '3',
          'subtype_name' => 'Foundation',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '15',
          'type_id' => '3',
          'subtype_name' => 'Framers',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '16',
          'type_id' => '3',
          'subtype_name' => 'Drywall',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '17',
          'type_id' => '3',
          'subtype_name' => 'Painters',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '18',
          'type_id' => '3',
          'subtype_name' => 'Landscapers',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '19',
          'type_id' => '3',
          'subtype_name' => 'Hardscape',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '20',
          'type_id' => '3',
          'subtype_name' => 'Cabinets and Counters',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '21',
          'type_id' => '3',
          'subtype_name' => 'Doors and Windows',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '22',
          'type_id' => '3',
          'subtype_name' => 'Arborists',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '23',
          'type_id' => '3',
          'subtype_name' => 'Pest Control',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '24',
          'type_id' => '3',
          'subtype_name' => 'Lock Smith',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '25',
          'type_id' => '3',
          'subtype_name' => 'Flooring',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '26',
          'type_id' => '3',
          'subtype_name' => 'Other Contractors',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '27',
          'type_id' => '6',
          'subtype_name' => 'Engineers',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '28',
          'type_id' => '6',
          'subtype_name' => 'Other Home Design',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '29',
          'type_id' => '5',
          'subtype_name' => 'Title',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '30',
          'type_id' => '5',
          'subtype_name' => 'Contract to Close Services',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '31',
          'type_id' => '5',
          'subtype_name' => 'Surveyors',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '32',
          'type_id' => '5',
          'subtype_name' => 'Home Warranty',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '33',
          'type_id' => '5',
          'subtype_name' => 'Inspectors',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '34',
          'type_id' => '5',
          'subtype_name' => 'Other Closing Services',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '35',
          'type_id' => '2',
          'subtype_name' => 'Traditional',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '36',
          'type_id' => '2',
          'subtype_name' => 'Commercial',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '37',
          'type_id' => '2',
          'subtype_name' => 'Hard Money',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '38',
          'type_id' => '2',
          'subtype_name' => 'Other Lenders',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '39',
          'type_id' => '7',
          'subtype_name' => 'Printing',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '40',
          'type_id' => '7',
          'subtype_name' => 'Signs',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '41',
          'type_id' => '7',
          'subtype_name' => 'Marketing Companies',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '42',
          'type_id' => '7',
          'subtype_name' => 'Photographers',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '43',
          'type_id' => '7',
          'subtype_name' => 'Other Marketing',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '44',
          'type_id' => '8',
          'subtype_name' => 'Loan Servicing',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '45',
          'type_id' => '8',
          'subtype_name' => 'Insurance Agents',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '46',
          'type_id' => '8',
          'subtype_name' => 'Bookkeeping',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '47',
          'type_id' => '8',
          'subtype_name' => 'CPAs',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '48',
          'type_id' => '8',
          'subtype_name' => 'Public Adjusters',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '49',
          'type_id' => '8',
          'subtype_name' => 'Banks',
      ]);

      $this->insert('vendor_sub_type', [
          'subtype_id' => '50',
          'type_id' => '8',
          'subtype_name' => 'Other Financial Services',
      ]);
               

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210908_153454_vendors_inital cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210908_153454_vendors_inital cannot be reverted.\n";

        return false;
    }
    */
}
