<?php

namespace  humhub\modules\stepstone_vendors;

use humhub\modules\content\models\ContentContainer;
use humhub\modules\content\models\ContentContainerModuleState;
use humhub\modules\search\events\SearchAttributesEvent;
use humhub\modules\stepstone_vendors\models\VendorsContentContainer;
use humhub\modules\space\models\Space;
use Yii;
//use yii\helpers\Url;
use humhub\modules\stepstone_vendors\helpers\Url;
use humhub\modules\stepstone_vendors\permissions\ManageVendors;


class Events
{

    public static function onSpaceMenuInit($event)
    {
        try {
            $space = $event->sender->space;
            if ($space->isModuleEnabled('stepstone_vendors')) {
                $event->sender->addItem([
                    'label' => Yii::t('StepstoneVendorsModule.base', 'Vendors'),
                    'group' => 'modules',
                    'url' => Url::toVendors($space),
                    'icon' => '<i class="far fa-address-book"></i>',
                    //'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'stepstone_vendors'),
                    'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'vendors'),
                ]);
            }
        } catch (\Throwable $e) {
            Yii::error($e);
        }
    }

    /**
     * Defines what to do when the top menu is initialized.
     *
     * @param Events $event
     */
    public static function onTopMenuInit($event)
    {
        $event->sender->addItem([
            'label' => 'Vendors',
            'icon' => '<i class="far fa-address-book"></i>',
            //'url' => Url::to(['/stepstone_vendors/index']),
            'url' => Url::to(['/s/welcome-space/stepstone_vendors/vendors']),
            'sortOrder' => 99999,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'stepstone_vendors' && Yii::$app->controller->id == 'global'),
        ]);
    }

    /**
     * Defines what to do if admin menu is initialized.
     *
     * @param Events $event
     */

    public static function onAdminMenuInit($event): void
    {
        /** @var AdminMenu $adminMenuWidget */
        $adminMenuWidget = $event->sender;

        $event->sender->addItem([
            'label' => Yii::t('StepstoneVendorsModule.base', 'Vendors'),
            'url' => ['/stepstone_vendors/admin'],
            'group' => 'manage',
            'icon' => '<i class="far fa-address-book"></i>',
            'sortOrder' => 99800,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'vendors' && Yii::$app->controller->id == 'admin'),
            'isVisible' => Yii::$app->user->can(ManageVendors::class)
        ]);

        $event->sender->addItem([
            'label' => 'Vendor Types',
            'url' => Url::to(['/stepstone_vendors/admin/vendortypes']),
            'group' => 'manage',
            'icon' => '<i class="far fa-users-class"></i>',
            'sortOrder' => 99801,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'vendors' && Yii::$app->controller->id == 'admin'),
            'isVisible' => Yii::$app->user->can(ManageVendors::class)
        ]);
        
        $event->sender->addItem([
            'label' => 'Vendor Areas',
            'url' => Url::to(['/stepstone_vendors/admin/vendorareas']),
            'group' => 'manage',
            'icon' => '<i class="fas fa-map-marker-alt"></i>', 
            'sortOrder' => 99802,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'vendors' && Yii::$app->controller->id == 'admin'),
            'isVisible' => Yii::$app->user->can(ManageVendors::class)
        ]);
        

    }

    public static function onSearchRebuild($event)
    {
      foreach (VendorsContentContainer::find()->each() as $vendor) {
        Yii::$app->search->add($vendor);
      }
    }

    public static function onSearchAttributes(SearchAttributesEvent $event)
    {
      if (!isset($event->attributes['vendors'])) {
          $event->attributes['vendors'] = [];
      }

//      foreach (VendorsContentContainer::findAll as $vendor) {
//
//        $event->attributes['vendors'][$vendor->id] = [
//          'vendor_name' => $vendor->vendor_name,
//          'vendor_contact' => $vendor->vendor_contact
//        ];
//
//        Event::trigger(Search::class, Search::EVENT_SEARCH_ATTRIBUTES, new SearchAttributesEvent($event->attributes['vendors'][$vendor->id], $vendors));
//      }

    }
    
    public static function addVendorDashboard($event){
      
      if (Yii::$app->hasModule('stepstone_vendors')) {      
        $event->sender->addWidget(widgets\VendorDashboard::class, [], ['sortOrder' => 100]);
      }  
    }
    



}
