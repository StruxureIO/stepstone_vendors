<?php
use humhub\modules\stepstone_vendors\widgets\VendorsWidget;
//require_once "protected/modules/vendors/widgets/VendorsWidget.php";
?>

<div class="container">
    <div class="row">
      
      <div class="col-md-3"> <!--menu column-->
        <div class="panel panel-default left-navigation">
          
           <?= VendorsWidget::widget(); ?> 
                    
        </div>  
      </div>  
      
    <div class="col-md-9">
      
      <?= $content ?>
      
    </div>       
  </div>
</div>

<script>
      $(document).ready(function(){
        $("a[href$='/s/welcome-space/stepstone_vendors/vendors']").parent().addClass('active');
      });
</script>