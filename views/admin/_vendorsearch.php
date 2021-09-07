<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CountrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

   
    <div class="form-group">
        <input type="text" id="vendorsearch-type_name" class="form-control" name="VendorsSearch[vendor_name]" style="display:inline-block;">      
        <div id="vendors-admin-search-wraper">
          <?= Html::submitButton('<i class="fa fa-search"></i>', ['id' => 'vendors-admin-search', 'class' => 'btn pull-right']) ?>
          
        </div>  
    </div>

    <?php ActiveForm::end(); ?>

</div>
