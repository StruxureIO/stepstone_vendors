<?php

use humhub\modules\stepstone_vendors\assets\Assets;
use humhub\modules\content\helpers\ContentContainerHelper;

// Register our module assets, this could also be done within the controller
Assets::register($this);

$container = ContentContainerHelper::getCurrent();
$container_guid = ($container) ? $container->guid : null;

?>

<div class="container-fluid">

  <div class="panel panel-default">
    
    <div id="vendor-page-title" class="panel-heading"><strong>All</strong> Vendors</div>
    
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        
        <div class="form-group form-group-search">
          <input id="vendors-search-text" type="text" class="form-control form-search" name="keyword" value="" placeholder="search for vendors">
          <button id="vendors-search" type="submit" class="btn btn-default btn-sm form-button-search">Search</button>
        </div>
        
                
      </div>
      <div class="col-md-3"></div>
    </div>    
    
    <div class="row">
      <div class="col-md-12">         
        <div id="location-filters">
          <?php 
            foreach($areas as $area) { 
              echo "<a class='area-filter' data-id='{$area['area_id']}'>{$area['area_name']}</a>";
            } 
          ?>
        </div>
        <input type="hidden" id="current-vendor-subtype" value="">
        <input type="hidden" id="current-location" value="">
      </div>    
    </div>    

    
    <div class="panel-body">
      
      <div id="alwrap">
        <div id="ajaxloader"></div>
      </div>          

      <div id="vendors-list"></div>
                 
    </div>      
        
  </div>

</div>
<?php
$ajax_rating = yii\helpers\Url::to(['ajax-rating']);
$ajax_view = yii\helpers\Url::to(['ajax-view']);
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;

$this->registerJs("
  
  load_all_vendors(0);
  
  function load_vendors(page, vendor_id, location = '') {
  
    $('#ajaxloader').show();
    
    var selected_vendors = new Array(vendor_id);
    
    var vendor_ids = JSON.stringify(selected_vendors.join());
  
    var search_text = '';
      
    $.ajax({
      'type' : 'GET',
      'url' : '$ajax_view',
      'dataType' : 'json',
      'data' : {
        'cguid' : '$container_guid',
        '$csrf_param' : '$csrf_token',
        'vendor_ids' : vendor_ids,  
        'location' : location,
        'page' : page,
        'search_text' : search_text
      },
      'success' : function(data){
        $('#ajaxloader').hide();
        $('#vendor-page-title').html(data.title);
        $('#vendors-list').html(data.html);
      }
    });
  
  }

  function load_all_vendors(page, search_text = '', location = '') {
    $('#ajaxloader').show();
    
    //console.log('search_text', search_text);
    
    var selected_vendors = new Array();
  
    jQuery('input[type=checkbox].vendor-type:checked').each(function() {  
      selected_vendors[selected_vendors.length] = jQuery(this).attr('data-id');
    });
    
    if(selected_vendors.length > 0) 
      var vendor_ids = JSON.stringify(selected_vendors.join());
    else
      var vendor_ids = '';

    $.ajax({
      'type' : 'GET',
      'url' : '$ajax_view',
      'dataType' : 'json',
      'data' : {
        'cguid' : '$container_guid',
        '$csrf_param' : '$csrf_token',
        'vendor_ids' : vendor_ids,  
        'location' : location,
        'page' : page,
        'search_text' : search_text
      },
      'success' : function(data){
        $('#ajaxloader').hide();
        $('#vendor-page-title').html(data.title);
        $('#vendors-list').html(data.html);
      }
    });
  }
  
  
  function update_user_rating(user_rating, vendor_id, user_id) {
    
    $('#ajaxloader').show();
    $.ajax({
      'type' : 'GET',
      'url' : '$ajax_rating',
      'dataType' : 'html',
      'data' : {
        'cguid' : '$container_guid',
        '$csrf_param' : '$csrf_token',
        'user_rating' : user_rating,  
        'vendor_id' : vendor_id,
        'user_id' : user_id
      },
      'success' : function(data){
        $('#ajaxloader').hide();
      }
    });

  }
  
  $(document).on('click', '#step-vendors-prev, #step-vendors-next', function (e) {  
    e.stopImmediatePropagation();
    var page = $(this).attr('data-page-id');       
    var search_text = $(this).attr('data-search-text');   
    //console.log('search_text page', search_text);
    load_all_vendors(page, search_text);
  });
  
  $('#vendors-search-text').on('keypress',function(e) {
    e.stopImmediatePropagation();
    if(e.which == 13) {
      do_vendors_search();
    }
  });
  
  $(document).on('click', '#vendors-search', function (e) {  
    e.stopImmediatePropagation();
    do_vendors_search();
  });
  
  function do_vendors_search() {
    //$('.vendor-type').prop('checked', false);
    var search_text = $('#vendors-search-text').val();
    console.log('search_text', search_text);
    
    $('#ajaxloader').show();
    $.ajax({
      'type' : 'GET',
      'url' : '$ajax_view',
      'dataType' : 'json',
      'data' : {
        'cguid' : '$container_guid',
        '$csrf_param' : '$csrf_token',
        'search_text' : search_text,
        'vendor_ids' : '',  
        'location' : '',
        'page' : 0
      },
      'success' : function(data){
        $('#ajaxloader').hide();
        $('#vendors-list').html(data.html);
      }
    });
  }  
  
  $(document).on('click', '.vendor-list-type', function (e) {  
  
    var vendor_id = $(this).attr('data-id');           
    
    var location = $('#current-location').val();
    
    $('#current-vendor-type').val(vendor_id);
    
    console.log('vendor_id', vendor_id);
    
    jQuery('a.vendor-list-type').each(function() {  
      $(this).removeClass('selected-vendor');
    });    
    
    $(this).addClass('selected-vendor');
    
    load_vendors(0, vendor_id, location);
  });
  
//  $(document).on('click', '.vendor-subtype', function (e) {  
//    e.stopImmediatePropagation();
//    var vendor_subtype = $(this).attr('data-id'); 
//    var location = $('#current-location').val();    
//    console.log('vendor_subtype', vendor_subtype);
//    $('#current-vendor-subtype').val(vendor_subtype);    
//    load_vendors_subtype(0, vendor_subtype, location);
//  });
  
  function load_vendors_subtype(page, vendor_subtype, location) {
  
    $('#ajaxloader').show();
    
    var vendor_ids = 0;
    
    $.ajax({
      'type' : 'GET',
      'url' : '$ajax_view',
      'dataType' : 'json',
      'data' : {
        'cguid' : '$container_guid',
        '$csrf_param' : '$csrf_token',
        'search_text' : '',
        'vendor_ids' : vendor_ids,
        'vendor_subtype' : vendor_subtype,
        'location' : location,
        'page' : page
      },
      'success' : function(data){
        $('#ajaxloader').hide();
        $('#vendor-page-title').html(data.title);
        $('#vendors-list').html(data.html);
      }
    });
  }

  $(document).on('click', '.area-filter', function (e) {  
    e.stopImmediatePropagation();
    var location = $(this).attr('data-id');    
    $('#current-location').val(location);
    var vendor_subtype = $('#current-vendor-subtype').val();       
    var vendor_type = $('#current-vendor-type').val();
    
    console.log('location ', location);
    load_vendors(0, vendor_type, location);
    //load_vendors_subtype(0, vendor_subtype, location);
  });


");
?>

  
      
        


