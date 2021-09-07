<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\humhub\modules\stepstone_vendors\assets\Assets::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Vendortypes */

$this->title = 'Add New Type';
$this->params['breadcrumbs'][] = ['label' => 'Vendor Types', 'url' => ['admin/add-type']];
$this->params['breadcrumbs'][] = 'Add';

?>
<div class="tag-update">

    <?= $this->render('_typeform', [
        'model' => $model,
    ]) ?>

</div>
