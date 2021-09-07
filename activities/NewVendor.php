<?php

namespace humhub\modules\stepstone_vendors\activities;

use humhub\modules\activity\components\BaseActivity;
use humhub\modules\activity\interfaces\ConfigurableActivityInterface;
use Yii;

class NewVendor extends BaseActivity implements ConfigurableActivityInterface
{

    /**
     * @inheritdoc
     */
    public $moduleId = 'stepstone_vendors';
    
    /**
     * @inheritdoc
     */
    public $viewName = 'newVendor';

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return Yii::t('StepstoneVendorsModule.activities', 'Vendors');
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return Yii::t('StepstoneVendorsModule.activities', 'Whenever a new vendor is added.');
    }

}
