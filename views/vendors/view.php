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
    'messageStreamEmpty' => Yii::t('StepstoneVendorsModule.base', 'There are no comments about this vendor, start the conversation!'),
])?>
HTML;

?>

<?php humhub\modules\devtools\widgets\CodeView::end();