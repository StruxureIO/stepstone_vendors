<?php

namespace humhub\modules\stepstone_vendors\notifications;

use humhub\modules\notification\components\BaseNotification;

class VendorAdded extends BaseNotification
{
    public $moduleId = 'stepstone_vendors';
    public $requireOriginator = false;
    public $requireSource = false;

    public function html()
    {
        return '<h1>TestedMailViewNotificationHTML</h1>';
    }

    public function text()
    {
        return 'TestedMailViewNotificationText';
    }
}
