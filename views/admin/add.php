<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\humhub\modules\stepstone_vendors\assets\Assets::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Vendortypes */

$this->title = 'Add New Vendor';
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => ['admin/add']];
$this->params['breadcrumbs'][] = 'Add';

?>
<div class="tag-update">

    <?= $this->render('_form', [
        'model' => $model, 
        'types' => $types,
        'areas' => $areas,
        'user' => $user, 
        'current_user_id' => $current_user_id,
    ]) ?>
    

</div>
