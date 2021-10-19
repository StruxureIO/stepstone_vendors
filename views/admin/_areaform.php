<?php
//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VendorAreas */
/* @var $form yii\widgets\ActiveForm */


?>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading"><strong><?= Html::encode($this->title) ?></strong></div>
      <div id="vendor-type-form">
    
      <?php $form = ActiveForm::begin(); ?>
    
          <input type="hidden" name="VendorAreas[area_id]" value="<?php echo $model->area_id ?>">
          
          
          <table id="vendor-type" class="table-padding">
            <thead>
              <tr>
                <td class="tb-tag-name"><strong>Area Name</strong></td>
              </tr>
            </thead>
            <tbody>
              <tr data-id="<?php echo $model->area_id ?>">
                <td class="tb-type-name"><input class="step-vender-type" name="VendorAreas[area_name]" type="text" value="<?php echo $model->area_name ?>"></td>                
              </tr>                              
            </tbody>
          </table>
                        
      <div class="form-group">
          <?= Html::submitButton('Save', ['class' => 'btn btn-default']) ?>
      </div>

      <!--display validation errors-->
      <?= $form->errorSummary($model); ?>    

      <?php ActiveForm::end(); ?>
      
    </div>
    
    
  </div>
</div>

