<?php

namespace humhub\modules\stepstone_vendors\helpers;

use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\user\models\User;

use yii\helpers\Url as BaseUrl;

class Url extends BaseUrl {


    public static function toVendors(ContentContainerActiveRecord $container = null)
    {
        if($container) {
            return $container->createUrl('/stepstone_vendors/vendors');
        }

        return static::toGlobalVendors();
    }
    
    public static function toGlobalVendors()
    {
        return static::to(['/stepstone_vendors/index']);
    }
    
    public static function toAddVendors(ContentContainerActiveRecord $container = null) {
      
      if($container) {
        return $container->createUrl('/stepstone_vendors/index/add');
      }
      return '/stepstone_vendors/index/';
      
    }
    
    

}