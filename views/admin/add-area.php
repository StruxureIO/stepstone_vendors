<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\humhub\modules\stepstone_vendors\assets\Assets::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\VendorAreas */

$this->title = 'Add New Area';
$this->params['breadcrumbs'][] = ['label' => 'Vendor Areas', 'url' => ['admin/add-area']];
$this->params['breadcrumbs'][] = 'Add';

?>
<div class="tag-update">

    <?= $this->render('_areaform', [
        'model' => $model,
    ]) ?>

</div>
