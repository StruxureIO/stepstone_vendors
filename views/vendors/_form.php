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
    
          <!--<input type="hidden" name="VendorsContentContainer[id]" value="< ?php echo $model->id ?>">-->
                              
          <?= $form->field($model, 'vendor_name')->textInput(['maxlength' => true]) ?>
          
          <label class="control-label" for="VendorsContentContainer[vendor_type]">Vendor Type</label>
          <div id="vendor-select-row">
             <?= Html::activeDropDownList($model, 'vendor_type', $types, ['class' => 'form-control']) ?>             
          </div>
          
          <label class="control-label" for="VendorsContentContainer[vendor_type]">Vendor Subtype</label>
          <div id="vendor-select-row">
             <?= Html::activeDropDownList($model, 'subtype', $subtypes, ['class' => 'form-control']) ?>             
<!--            <select id="vendors-subtype" class="form-control" name="VendorsContentContainer[subtype]">
            </select>             -->
          </div>
            <!--<option value="2">Lenders</option>-->
          
                    
          <?= $form->field($model, 'vendor_contact')->textInput(['maxlength' => true]) ?>
                    
          <?= $form->field($model, 'vendor_phone')->textInput(['maxlength' => true]) ?>
                    
          <?= $form->field($model, 'vendor_email')->textInput(['maxlength' => true]) ?>
          
          <input type="hidden" id="vendor-areas" name="VendorsContentContainer[areas]" value="">            
          
          <div class="form-group field-vendors-vendor_areas">
            <label class="control-label" for="vendors-areas">Vendor Areas</label>
            
            <ul id="tag-list">
              
              <?php
                $selected_areas = explode(',', $model->areas);      
                foreach($areas as $area) {     
                  
                  if(in_array($area->area_id, $selected_areas))
                    $checked = 'checked';      
                  else
                    $checked = '';      
                  
                  echo '<li><label class="switch"><input class="step-vendor-area" type="checkbox" '.$checked.' data-id="'.$area->area_id.'" ><span class="slider round"></span></label><span class="tag-label">'.$area->area_name.'</span></li>';                  
                }
              ?>  
                            
            </ul>  
            

          </div>            
          
          <!--< ?= $form->field($model, 'vendor_area')->textInput(['maxlength' => true]) ?>-->
                                                  
          <?php if(!isset($user->username)) { ?>
            <input type="hidden" id="vendor_recommended_user_id" name="VendorsContentContainer[vendor_recommended_user_id]" value="<?php echo $current_user_id ?>">
          <?php } else { ?>
            <div>
              <label class="control-label">Recommended by </label> <?= $user->username ?>            
            </div>
          <?php } ?>
          
          
          <?php $rating = ($model->vendor_rating) ? number_format($model->vendor_rating) : 0; ?>
          <div>
            <label class="control-label">Rating </label> <?= $rating ?>            
          </div>
          
          
                        
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-default']) ?>
    </div>
    
    <!--display validation errors-->
    <?= $form->errorSummary($model); ?>    
       

    <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
<?php
$ajax_getsubtypes = yii\helpers\Url::to(['ajax-subtypes']);
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;

$this->registerJs("

	$(document).on('change', '#vendorscontentcontainer-vendor_type', function (e) {						
    e.stopImmediatePropagation();    
    var vendor_type = $('select#vendorscontentcontainer-vendor_type option').filter(':selected').val();
    
    console.log('vendor_type', vendor_type);
    
    $('#ajaxloader').show();
    $.ajax({
      'type' : 'GET',
      'url' : '$ajax_getsubtypes',
      'dataType' : 'html',
      'data' : {
        'cguid' : '$cguid',
        '$csrf_param' : '$csrf_token',
        'vendor_type' : vendor_type
      },
      'success' : function(data){
        $('#ajaxloader').hide();
        $('#vendorscontentcontainer-subtype').html(data);
      }
    });
    // 'cguid' : 'container_guid',
    
  });

");
?>