<?php humhub\modules\devtools\widgets\CodeView::begin(['type' => 'php']); ?>

<?=

<<<HTML

<?php
use humhub\modules\stepstone_vendors\widgets\ContentInfoStreamFilterNavigation;
use humhub\modules\stream\widgets\StreamViewer;

?>

<?= StreamViewer::widget([
    'streamAction' => '/stepstone_vendors/stream/stream',
    'streamFilterNavigation' => ContentInfoStreamFilterNavigation::class,
    'messageStreamEmpty' => Yii::t('StepstoneVendorsModule.base', 'Sees there are no entries available, create some first to see this example work!'),
])?>
HTML;

?>

<?php humhub\modules\devtools\widgets\CodeView::end();