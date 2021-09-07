<?php
//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use humhub\modules\stepstone_vendors\models\VendorSubTypes;

/* @var $this yii\web\View */
/* @var $model app\models\VendorTypes */
/* @var $form yii\widgets\ActiveForm */

//$subtypes = new VendorSubTypes();
if(isset($model->type_id)) {
  $connection = Yii::$app->getDb();
  $command = $connection->createCommand("select subtype_id, subtype_name from vendor_sub_type where type_id = " . $model->type_id . " order by subtype_name");
  $subtypes = $command->queryAll();   
}

?>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading"><strong><?= Html::encode($this->title) ?></strong></div>
      <div id="vendor-type-form">
    
      <?php $form = ActiveForm::begin(); ?>
    
          <input type="hidden" name="VendorTypes[type_id]" value="<?php echo $model->type_id ?>">
          
          
          <table id="vendor-type" class="table-padding">
            <thead>
              <tr>
                <td class="tb-tag-name"><strong>Type Name</strong></td>
              </tr>
            </thead>
            <tbody>
              <tr data-id="<?php echo $model->type_id ?>">
                <td class="tb-type-name"><input class="step-vender-type" name="VendorTypes[type_name]" type="text" value="<?php echo $model->type_name ?>"></td>                
              </tr>                              
            </tbody>
          </table>
                        
      <div class="form-group">
          <?= Html::submitButton('Save', ['class' => 'btn btn-default']) ?>
      </div>

      <!--display validation errors-->
      <?= $form->errorSummary($model); ?>    


      <?php ActiveForm::end(); ?>

      <?php if(isset($model->type_id)) { ?>
      <div>
        <p><strong>Vendor Subtypes</strong></p>
        
        <?php //print_r($subtypes) ?>
       
        <table id="vendor-subtypes">
          <tbody>
          <?php
          // $subtype['subtype_id']
          $count = 0;
          foreach($subtypes as $subtype) {
            if($count % 2)
              echo '<tr>' . PHP_EOL;
            else
              echo '<tr class="gray">' . PHP_EOL;
            echo '  <td class="sbty-name">' . $subtype['subtype_name'] . '</td>'  . PHP_EOL;
            //echo '  <td class="sbty-edit"><a href=""><span class="glyphicon glyphicon-pencil"></span></a></td>'  . PHP_EOL;
            //echo '  <td class="sbty-delete"><a href=""><span class="glyphicon glyphicon-trash"></span></a></td>'  . PHP_EOL;
            echo '<td class="sbty-edit">' . Html::a( '<span class="glyphicon glyphicon-pencil"></span>' , Url::to("index.php?r=stepstone_vendors/admin/updatesubtype&subtype_id=" . $subtype['subtype_id'] . "&id=" . $model->type_id . "&name=" . $model->type_name)) . '</td>';
            echo '<td class="sbty-delete">' . Html::a( '<span class="glyphicon glyphicon-trash"></span>' , Url::to("index.php?r=stepstone_vendors/admin/deletesubtype&subtype_id=" . $subtype['subtype_id'] . "&id=" . $model->type_id))  . '</td>';
            echo '</tr>' . PHP_EOL;
            $count++;
          }

          ?>
          </tbody>
          
          <div>
            <a id="step-add-video-tag" href="<?php echo Url::base() ?>/index.php?r=stepstone_vendors%2Fadmin%2Faddsubtype&id=<?php echo $model->type_id ?>&name=<?php echo $model->type_name?>" class="btn btn-default">Add Subtype</a>&nbsp;&nbsp;            
          </div>
        </table>

      </div>
      <?php } ?>
      
    </div>
    
    
  </div>
</div>

