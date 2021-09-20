<?php

namespace humhub\modules\stepstone_vendors\notifications;

use humhub\modules\notification\components\BaseNotification;
use humhub\modules\space\models\Space;
use humhub\modules\stepstone_vendors\models\Vendors;
use humhub\modules\stepstone_vendors\models\VendorsContentContainer;
use Yii;
use yii\bootstrap\Html;
use yii\db\IntegrityException;
use yii\helpers\VarDumper;

class VendorAdded extends BaseNotification
{
    public $moduleId = 'stepstone_vendors';
    public $requireOriginator = false;
    public $requireSource = false;

    /**
     * @inheritdoc
     */
    public $viewName = 'vendor-added';

    /**
     * @inheritdoc
     * @throws IntegrityException
     */
    public function getUrl()
    {
        if ($this->originator === null) {
            throw new IntegrityException('Originator cannot be null.');
        }

        return $this->originator->getUrl();
    }

    /**
     * @inheritdoc
     */
    public function html()
    {
        /**@var VendorsContentContainer $vendorsContentContainer */
        $vendorsContentContainer = $this->source;
        return Yii::t('UserModule.notification', 'User {displayName} has added the Vendor - {vendorName}.', [
            'displayName' => $this->originator->displayName,
            'vendorName' => $vendorsContentContainer->vendor_name
        ]);
    }
}
