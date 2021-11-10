<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\stepstone_vendors\widgets;

use humhub\modules\content\widgets\stream\WallStreamEntryWidget;
use yii\helpers\VarDumper;

/**
 * @inheritdoc
 */
class VendorCommentsWallEntry extends WallStreamEntryWidget
{

    /**
     * @inheritdoc
     */
    public $editRoute = '/post/post/edit';

    /**
     * @inheritdoc
     */
    protected function renderContent()
    {
        return $this->render('vendorCommentsWallEntry', [
            'post' => $this->model,
            'justEdited' => $this->renderOptions->isJustEdited(), // compatibility for themed legacy views
            'renderOptions' => $this->renderOptions
        ]);
    }
}
