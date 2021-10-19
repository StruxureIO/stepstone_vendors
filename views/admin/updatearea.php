<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\humhub\modules\stepstone_vendors\assets\Assets::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\VendorAreas */

$this->title = 'Update Vendor Area: ' . $model->area_name;
$this->params['breadcrumbs'][] = ['label' => 'Vendor Areas', 'url' => ['admin/vendorareas']];
$this->params['breadcrumbs'][] = ['label' => $model->area_name, 'url' => ['view', 'id' => $model->area_id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="tag-update">

    <?= $this->render('_areaform', [
        'model' => $model,
    ]) ?>

</div>
