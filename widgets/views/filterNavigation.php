<?php
use humhub\libs\Html;
use humhub\modules\stepstone_vendors\stream\OwnContentStreamFilter;
use humhub\modules\ui\filter\widgets\CheckboxFilterInput;
use humhub\modules\ui\view\components\View;

/* @var $this View */
/* @var $options []  */

?>

<?= Html::beginTag('div', $options)?>

    <?= CheckboxFilterInput::widget([
        'id' => OwnContentStreamFilter::FILTER_NAME,
        'title' => Yii::t('StepstoneVendorsModule.base','Only show my own content')
    ])?>

<?= Html::endTag('div')?>
