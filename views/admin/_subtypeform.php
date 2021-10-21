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
                <td class="type-table-space">&nbsp;</td>
                <td class="tb-tag-name"><strong>Icon</strong></td>
              </tr>
            </thead>
            <tbody>
              <tr data-id="<?php echo $model->type_id ?>">
                <td class="tb-type-name"><input class="step-vender-type" name="VendorSubTypes[subtype_name]" type="text" value="<?php echo $model->subtype_name ?>"></td>                
                <td class="type-table-space">&nbsp;</td>
                <td class="tb-type-name"><input class="step-vender-icon" name="VendorSubTypes[icon]" type="text" value="<?php echo $model->icon ?>"></td>                
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
<?php
$this->registerJs("
  
	$(document).on('change', '.step-vender-icon', function (e) {						
    e.stopImmediatePropagation();    
    var new_icon = $(this).val();
    //console.log('icon',new_icon);
    
    if(new_icon != '') {
      var start = new_icon.indexOf('\"');
      var end = new_icon.lastIndexOf('\"');
      if(start != -1) {      
        var icon_class = new_icon.substring(start+1, end);
        $(this).val(icon_class);      
      }
    }
    
  });
  
");
?>
