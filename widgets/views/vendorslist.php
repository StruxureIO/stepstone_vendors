<?php
//use yii\helpers\Url;
use humhub\modules\stepstone_vendors\helpers\Url;
use humhub\modules\stepstone_vendors\helpers\VendorsEntry;
?>

<div class="panel-heading">
  <strong>Vendor</strong> Types
  <input type="hidden" id="current-vendor-type" value="" >
</div>

<?php if($types) { ?>
  <?php foreach($types as $type) { ?>
    <div class="list-group">
      <div class="list-group-item">
        <!--<input id="ck-< ?php echo $type->type_id ?>" type="checkbox" class="vendor-type pull-right" data-id="< ?php echo $type->type_id ?>" > <label for="ck-< ?php echo $type->type_id ?>">< ?php echo $type->type_name ?></label>-->
        
        <details>
          <summary class="vendor-list-type" data-id="<?php echo $type->type_id ?>"><i class="<?php echo $type->icon ?>"></i> <?php echo $type->type_name ?></summary>
          <dl>
          <?php
            $subtypes = VendorsEntry::getSubTypes($type->type_id);                       
            if(count($subtypes) > 0) {
              foreach($subtypes as $subtype) { 
                echo '<dt><span class="subtype-icon"><i class="' . $subtype['icon'] . '"></i></span> <a class="vendor-subtype" data-id="' . $subtype['subtype_id'] . '">' . $subtype['subtype_name'] . '</a></dt>';              
              }           
            }
          ?>
         </dl>
        </details>        
                
      </div>
    </div>       
  <?php } ?>
<?php } ?>


<?php if(!empty($container_guid)) { ?>
<hr>

  <p id="vendor-button-row">
    <!--<a class="btn btn-default" href="< ?php echo Url::base() ? >/index.php?r=stepstone_vendors%2Fvendors%2Fadd&cguid=<?php echo $container_guid ?>">Add Vendor</a>-->
    <a class="btn btn-default" href="<?php echo $add_url ?>">Add Vendor</a>
        
  </p>
<?php } ?>

