<?php

namespace humhub\modules\stepstone_vendors\notifications;

use humhub\modules\notification\components\BaseNotification;
use Yii;
use yii\bootstrap\Html;

class VendorAdded extends BaseNotification
{
    public $moduleId = 'stepstone_vendors';
    public $requireOriginator = false;
    public $requireSource = false;

    public function html()
    {
        return 'New Vendor Added!!!';
//        return Yii::t('UserModule.notification', '{displayName} is now following you.', [
//            'displayName' => Html::tag('strong', 'Test' ),
//        ]);
//        Html::encode($this->originator->displayName)
    }

    public function text()
    {
        return 'TestedMailViewNotificationText 222';
    }
}
