<?php
//use yii\helpers\Url;
use humhub\modules\stepstone_vendors\helpers\Url;
use humhub\modules\stepstone_vendors\helpers\VendorsEntry;
?>

<div class="panel-heading">
  <strong>Vendor</strong> types
  <input type="hidden" id="current-vendor-type" value="" >
</div>

<?php if($types) { ?>
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  <?php foreach($types as $type) { ?>
        
    <div class="panel panel-default list-group vendor_type">
          <a class="collapsed  list-group-item" data-toggle="collapse" data-parent="#accordion" href="#<?= $type->type_id ?>Type" aria-expanded="true" aria-controls="<?= $type->type_id ?>Type">
            <i class="<?= $type->icon ?>"></i><?= $type->type_name ?>
          </a>
      <div id="<?= $type->type_id ?>Type" class="panel-collapse collapse list-group" role="tabpanel" aria-labelledby="headingOne">

          <?php
            $subtypes = VendorsEntry::getSubTypes($type->type_id);                       
            if(count($subtypes) > 0) {
              foreach($subtypes as $subtype) { 
                echo '<a class="list-group-item vendor-subtype" href="#" data-id="' . $subtype['subtype_id'] . '"> '. $subtype['subtype_name'].' </a>';              
              }           
            }
          ?>



      </div>
    </div> <!-- panel -->

    <?php } ?>
  </div> <!-- panel-group -->

  <?php } ?>

  <?php if(!empty($container_guid)) { ?>
<hr>

  <div id="vendor-button-row">
    <a class="btn btn-default" href="<?php echo $add_url ?>">Add Vendor</a>
        
</div>
<?php } ?> 
