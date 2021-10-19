<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\humhub\modules\stepstone_vendors\assets\Assets::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Vendortypes */

$this->title = 'Update Vendor: ' . $model->vendor_name;
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => $model->vendor_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="tag-update">

    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
        'areas' => $areas,
        'user' => $user, 
        'subtypes' => $subtypes,
        'current_user_id' => $current_user_id,
]) ?>

</div>
