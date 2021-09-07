<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\humhub\modules\stepstone_vendors\assets\Assets::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Vendortypes */

$this->title = 'Add New Subtype for ' . $name;

?>

<div class="tag-update">

    <?= $this->render('_subtypeform', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
