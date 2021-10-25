<?php

namespace humhub\modules\stepstone_vendors\widgets;

use Yii;
use yii\helpers\Url;
use yii\db\Query;
use humhub\components\Widget;
use humhub\modules\stepstone_vendors\models\VendorsContentContainer;

/**
 *
 * @author Felli
 */
class VendorDashboard extends Widget
{
    public $contentContainer;

    /**
     * @inheritdoc
     */
    public function run() {
      
      
      $current_user_id = \Yii::$app->user->identity->ID;

      $connection = Yii::$app->getDb();
      
      $command = $connection->createCommand("select vendor_location from profile where user_id = $current_user_id");
      
      //$sql = $command->sql;

      $area = $command->queryAll();   
      
      if(isset($area[0]['vendor_location']) && $area[0]['vendor_location'] != null )
        $location = $area[0]['vendor_location'];
      else
        $location = 1;
                  
      $connection = Yii::$app->getDb();
      
      $command = $connection->createCommand("select v.id, vendor_name, t.type_name, s.subtype_name, t.icon as type_icon, s.icon as subicon from vendors as v
LEFT JOIN vendor_types as t on t.type_id = v.vendor_type 
LEFT JOIN vendor_sub_type as s on s.subtype_id = v.subtype  
LEFT JOIN vendor_area_list as a on a.vendor_id = v.id 
where area_id = $location
order by created_at desc limit 0, 4");

      //$sql = $command->sql;

      $vendors = $command->queryAll();   
      
               
      //return $this->render('vendordashboard', ['vendors' => $vendors, 'areas' => $areas]);
      return $this->render('vendordashboard', ['vendors' => $vendors]);
    }
        
}

