<?php

namespace humhub\modules\stepstone_vendors\widgets;

use Yii;
use humhub\modules\ui\menu\widgets\LeftNavigation;
use humhub\components\Widget;
use humhub\modules\stepstone_vendors\models;
use humhub\modules\content\helpers\ContentContainerHelper;

//include_once "protected/modules/stepstone_vendors/models/VendorTypes.php";


class VendorsWidget extends LeftNavigation
{
  
  public $mTypes;
  
  public function run() { 
    
    $this->mTypes = new \humhub\modules\stepstone_vendors\models\VendorTypes();
    
    $container = ContentContainerHelper::getCurrent();

    if($container != null)
      $add_url = $container->createUrl('/stepstone_vendors/vendors/add');
    else 
      $add_url = '';
    //$add_url = $this->contentContainer->createUrl('/stepstone_vendors/vendors/add');
    
    $container_guid = ($container) ? $container->guid : null;
        
    $types = $this->mTypes::find()->orderBy('type_name')->all();      
          
    return $this->render('vendorslist', ['types' => $types, 'container_guid' => $container_guid, 'add_url' => $add_url]); 
    
  }    

  
}
