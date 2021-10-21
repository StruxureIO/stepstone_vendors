<?php

namespace humhub\modules\stepstone_vendors;

if(defined('LOCALHOST')) {
  if(!defined('MAX_VENDOR_ITEMS')) 
    define('MAX_VENDOR_ITEMS', 3);
} else {
  if(!defined('MAX_VENDOR_ITEMS')) 
    define('MAX_VENDOR_ITEMS', 10);
}  

use Yii;
use yii\helpers\Url;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\content\components\ContentContainerModule;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\stepstone_vendors\models\VendorsContentContainer;
use humhub\modules\stepstone_videos\widgets;

class Module extends ContentContainerModule
{
    /**
    * @inheritdoc
    */
    public function getContentContainerTypes()
    {
        return [
            Space::class,
            User::class
        ];
    }

    /**
    * @inheritdoc
    */
    public function getConfigUrl()
    {
        return Url::to(['/vendors/admin']);
    }

    /**
    * @inheritdoc
    */
    public function disable()
    {
        // Cleanup all module data, don't remove the parent::disable()!!!
        parent::disable();
    }

    /**
    * @inheritdoc
    */
    public function disableContentContainer(ContentContainerActiveRecord $container)
    {
        // Clean up space related data, don't remove the parent::disable()!!!
        parent::disable();
    }

    /**
    * @inheritdoc
    */
    public function getContentContainerName(ContentContainerActiveRecord $container)
    {
        return Yii::t('StepstoneVendorsModule.base', 'Vendors');
    }

    /**
    * @inheritdoc
    */
    public function getContentContainerDescription(ContentContainerActiveRecord $container)
    {
        return Yii::t('StepstoneVendorsModule.base', 'This Vendors module V2 for StepStone.');
    }
    
    public function getContainerPermissions($contentContainer = null)
    {
        if ($contentContainer !== null) {
            return [
                new permissions\CreateVendors(),
                new permissions\ManageVendors(),
            ];
        }
        return [];
    }
    
    public static function onSidebarInit($event){
      if (Yii::$app->hasModule('stepstone_vendors')) {

        $event->sender->addWidget(widgets\Sidebar::className(), array(), array(
            'sortOrder' => 100
        ));
      }
    }    
    
}
