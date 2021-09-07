<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Vendors */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading"><strong><?= Html::encode($this->title) ?></strong></div>
      <div id="vendor-type-form">
    
      <?php $form = ActiveForm::begin(); ?>
    
          <input type="hidden" name="Vendors[id]" value="<?php echo $model->id ?>">
                              
          <?= $form->field($model, 'vendor_name')->textInput(['maxlength' => true]) ?>
          
          <label class="control-label" for="Vendors[vendor_type]">Vendor Type</label>
          <div id="vendor-select-row">
             <?= Html::activeDropDownList($model, 'vendor_type', $types, ['class' => 'form-control']) ?>             
          </div>
                    
          <?= $form->field($model, 'vendor_contact')->textInput(['maxlength' => true]) ?>
                    
          <?= $form->field($model, 'vendor_phone')->textInput(['maxlength' => true]) ?>
                    
          <?= $form->field($model, 'vendor_email')->textInput(['maxlength' => true]) ?>
          
          <?= $form->field($model, 'vendor_area')->textInput(['maxlength' => true]) ?>
                    
          <input type="hidden" id="vendor_recommended_user_id" name="Vendors[vendor_recommended_user_id]" value="<?php echo $current_user_id ?>">
                    
<!--          < ?php $rating = ($model->vendor_rating) ? number_format($model->vendor_rating) : 0; ?>
          <div>
            <label class="control-label">Rating </label> < ?= $rating ?>            
          </div>-->
                                  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-default']) ?>
    </div>
    
    <!--display validation errors-->
    <?= $form->errorSummary($model); ?>    
       

    <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>

