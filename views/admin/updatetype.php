<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\humhub\modules\stepstone_vendors\assets\Assets::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Vendortypes */

$this->title = 'Update Vendor Type: ' . $model->type_name;
$this->params['breadcrumbs'][] = ['label' => 'Vendor Types', 'url' => ['admin/vendortypes']];
$this->params['breadcrumbs'][] = ['label' => $model->type_name, 'url' => ['view', 'id' => $model->type_id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="tag-update">

    <?= $this->render('_typeform', [
        'model' => $model,
    ]) ?>

</div>
