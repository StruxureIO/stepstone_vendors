<?php

use humhub\modules\content\widgets\richtext\RichTextField;

?>

<?= RichTextField::widget([
    'id' => 'contentForm_message',
    'layout' => RichTextField::LAYOUT_INLINE,
    'pluginOptions' => ['maxHeight' => '300px'],
    'placeholder' => Yii::t("StepstoneVendorsModule.base", "Comment about this vendor"),
    'name' => 'message',
    'disabled' => (property_exists(Yii::$app->controller, 'contentContainer') && Yii::$app->controller->contentContainer->isArchived()),
    'disabledText' => Yii::t("StepstoneVendorsModule.base", "This space is archived."),
]); ?>
