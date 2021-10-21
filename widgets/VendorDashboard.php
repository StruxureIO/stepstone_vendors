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
      
      //$connection = Yii::$app->getDb();
      
      //$command = $connection->createCommand("select * from vendor_areas order by area_id");
      
      //$sql = $command->sql;

      //$areas = $command->queryAll();   
                  
      $connection = Yii::$app->getDb();
      
      $command = $connection->createCommand("select v.id, vendor_name, t.type_name, s.subtype_name, t.icon as type_icon, s.icon as subicon from vendors as v
LEFT JOIN vendor_types as t on t.type_id = v.vendor_type 
LEFT JOIN vendor_sub_type as s on s.subtype_id = v.subtype  
LEFT JOIN vendor_area_list as a on a.vendor_id = v.id 
where area_id = 1 
order by created_at desc limit 0, 4");

      //$sql = $command->sql;

      $vendors = $command->queryAll();   
      
               
      //return $this->render('vendordashboard', ['vendors' => $vendors, 'areas' => $areas]);
      return $this->render('vendordashboard', ['vendors' => $vendors]);
    }
    
    
    public function actionAjaxlocation($loction) {
      
      echo "Ajax";
      
      die();

    }
    
}

