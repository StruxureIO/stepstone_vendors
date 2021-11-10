<?php
use humhub\modules\stepstone_vendors\widgets\VendorsWidget;
//require_once "protected/modules/vendors/widgets/VendorsWidget.php";
?>

<div class="container">
    <div class="row">
      
      <div class="col-md-2"> <!--menu column-->
        <div class="panel panel-default left-navigation">
          
           <?= VendorsWidget::widget(); ?> 
                    
        </div>  
      </div>  
      
    <div class="col-md-10">
      
      <?= $content ?>
      
    </div>       
  </div>
</div>