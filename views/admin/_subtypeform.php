<?php
//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use humhub\modules\stepstone_vendors\models\VendorSubTypes;

/* @var $this yii\web\View */
/* @var $model app\models\VendorTypes */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading"><strong><?= Html::encode($this->title) ?></strong></div>
      <div id="vendor-type-form">
    
      <?php $form = ActiveForm::begin(); ?>
    
          <input type="hidden" name="VendorSubTypes[subtype_id]" value="<?php echo $model->subtype_id ?>">
          <input type="hidden" name="VendorSubTypes[type_id]" value="<?php echo $id ?>">
          
          
          <table id="vendor-type" class="table-padding">
            <thead>
              <tr>
                <td class="tb-tag-name"><strong>Subtype Name</strong></td>
              </tr>
            </thead>
            <tbody>
              <tr data-id="<?php echo $model->type_id ?>">
                <td class="tb-type-name"><input class="step-vender-type" name="VendorSubTypes[subtype_name]" type="text" value="<?php echo $model->subtype_name ?>"></td>                
              </tr>                              
            </tbody>
          </table>
                        
      <div class="form-group">
          <?= Html::submitButton('Save', ['class' => 'btn btn-default']) ?>
      </div>

      <?= $form->errorSummary($model); ?>    


      <?php ActiveForm::end(); ?>
     
    </div>
    
    
  </div>
</div>

