<?php

use humhub\widgets\Button;

// Register our module assets, this could also be done within the controller
\humhub\humhub\modules\template\assets\Assets::register($this);

$displayName = (Yii::$app->user->isGuest) ? Yii::t('StepstoneVendorsModule.base', 'Guest') : Yii::$app->user->getIdentity()->displayName;

// Add some configuration to our js module
$this->registerJsConfig("template", [
    'username' => (Yii::$app->user->isGuest) ? $displayName : Yii::$app->user->getIdentity()->username,
    'text' => [
        'hello' => Yii::t('StepstoneVendorsModule.base', 'Hi there {name}!', ["name" => $displayName])
    ]
])

?>

<div class="panel-heading"><strong>Template</strong> <?= Yii::t('StepstoneVendorsModule.base', 'overview') ?></div>

<div class="panel-body">
    <p><?= Yii::t('StepstoneVendorsModule.base', 'Hello World!') ?></p>

    <?=  Button::primary(Yii::t('StepstoneVendorsModule.base', 'Say Hello!'))->action("template.hello")->loader(false); ?></div>
