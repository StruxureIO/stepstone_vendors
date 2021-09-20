<?php

namespace humhub\modules\stepstone_vendors\notifications;

use humhub\modules\notification\components\BaseNotification;
use humhub\modules\space\models\Space;
use humhub\modules\stepstone_vendors\models\Vendors;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\VarDumper;

class VendorAdded extends BaseNotification
{
    public $moduleId = 'stepstone_vendors';
    public $requireOriginator = false;
    public $requireSource = false;

    public function html()
    {
        /**@var Vendors $vendor */
        $vendor = $this->source;
        Yii::error(VarDumper::dumpAsString($vendor));
//        $vendor = $this->source;

//        return Yii::t('UserModule.notification', 'Vendor {$vendorName} added.', [
//            'vendorName' => $vendor->vendor_name
//        ]);
        return 'dsadsasda';
    }
}
