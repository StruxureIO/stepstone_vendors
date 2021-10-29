<?php

use humhub\modules\stepstone_vendors\helpers\VendorsEntry;
use humhub\modules\content\helpers\ContentContainerHelper;

humhub\modules\stepstone_vendors\assets\Assets::register($this);

$container = ContentContainerHelper::getCurrent();
$container_guid = ($container) ? $container->guid : null;

if($container != null) {
  $detail_url = $container->createUrl('/stepstone_vendors/vendors/detail');
  $vendor_rate_url = $container->createUrl('/stepstone_vendors/vendors/rate-vendor');
  $vendor_url = $container->createUrl('/stepstone_vendors/vendors');
  $edit_vendor_url = $container->createUrl('/stepstone_vendors/vendors/update');  
} else {
  $detail_url = '';
  $vendor_rate_url = '';
  $vendor_url = '';
  $edit_vendor_url = '';
}  

if(isset($user_rating->user_id)) 
  $rating_user_id = $user_rating->user_id;
else
  $rating_user_id = 'not found';


if(isset($user_rating->user_rating)) 
  $current_user_rating = $user_rating->user_rating;
else 
  $current_user_rating = 0;

if(isset($user_rating->review)) 
  $review = $user_rating->review;
else 
  $review = '';

$user_id = \Yii::$app->user->identity->ID;
  

?>

<div class="container-fluid">

  <div class="panel panel-default">
        
    <?php VendorsEntry::vendorDetailHeader($vendor, $subtypes, $profile); ?>
    
  </div>    
  
  <div id="alwrap">
    <div id="ajaxloader" style="display: none;"></div>
  </div>  
  
  <div class="row">
    
    <div class="col-md-2"> 
      <?php VendorsEntry::vendorMenu($vendor->id, $detail_url, $vendor_rate_url, $vendor_url, $edit_vendor_url, $vendor->vendor_recommended_user_id) ?>
    </div>
    
    <div class="col-md-8"> 
      <p class="rating-section-title">Ratings</p>
      <p><?php //echo "user_id $user_id rating_user_id $rating_user_id $review" ?></p>
      <p><?php //print_r($user_rating) ?></p>
        <div id="rating-container">
          
          <?php 
          if($ratings) {
            $count = 0;
            foreach($ratings as $rating) {

              $rating_stars = VendorsEntry::display_vendor_rating($rating['user_rating']);

              $name = '';
              if(!empty($rating['firstname']))
                $name .= $rating['firstname'] . " "; 
              if(!empty($rating['lastname']))
                $name .= $rating['lastname']; 

              $date = date("m/d/Y", strtotime($rating['rating_date']));

              echo "<div class='rating-box'>" . PHP_EOL;
              if($count != 0)
                echo "  <hr class='rating-divider'>" . PHP_EOL;
              echo "  <div class='rating-line-1'>$rating_stars <span class='rating-box-name'>" . $name . " <span class='rating-box-date'>($date)</span></div>". PHP_EOL;
              if(!empty($rating['review']))
                echo "  <p class='rating-line-2'>" . $rating['review'] .  "</p>". PHP_EOL;                        
              echo "</div>" . PHP_EOL;
              $count++;

            }
            
          } else {
            echo "<div class='no-rating-box'>" . PHP_EOL;
            echo "No ratings were found for this vendor. Be the first to submit a rating." . PHP_EOL;
            echo "</div>" . PHP_EOL;
          }
          
          ?>

        </div>
      
        <p class="rating-section-title">Rate Vendor</p>
        
      
        <div id="submit-new-rating">
          <div class="rating-box">
            
            
            <?php  echo '  <div id="rating-row">' . VendorsEntry::display_vendor_user_rating($current_user_rating, $vendor->id, $user_id) . '</div>'. PHP_EOL; ?>
            <div id="review-row">
              <textarea id="vendor-user-review" placeholder="Review of Vendor"><?php echo $review ?></textarea>
            </div>
            
            <div id="submit-row">
              <a id="submit-review">Submit</a>
            </div>
            
          </div>
          <!--display_vendor_rating($rating['user_rating'])-->
          

        </div>
    </div>
    
    <div class="col-md-2"> 
      <div id="latest-ratings">
        <?php VendorsEntry::latestRatings($latest_ratings) ?>        
      </div>
    </div>
  
  
    
</div>    
<?php
$ajax_rating = yii\helpers\Url::to(['ajax-rating']);
$ajax_review = yii\helpers\Url::to(['ajax-review']);
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;
$vendor_id = $vendor->id;

$this->registerJs("
  var has_rating = ($current_user_rating) ? true : false;
         
  $(document).on('click', '.vendor-rate-1', function (e) {  
    e.stopImmediatePropagation();
    has_rating = true;
    var user_id = $(this).parent().attr('user-id');      
    var vendor_id = $(this).parent().attr('data-id');      
    //console.log('vendor_id',vendor_id,'user_id',user_id);
    if($(this).hasClass('checked')) {
      //$(this).removeClass('checked');
      $(this).siblings('.vendor-rate-2').removeClass('checked');        
      $(this).siblings('.vendor-rate-3').removeClass('checked');        
      $(this).siblings('.vendor-rate-4').removeClass('checked');        
      $(this).siblings('.vendor-rate-5').removeClass('checked');        
      $(this).parent().attr('user-rating','1');      
      //update_user_rating(1, vendor_id, user_id);
    } else {
      $(this).addClass('checked');
      $(this).siblings('.vendor-rate-2').removeClass('checked');        
      $(this).siblings('.vendor-rate-3').removeClass('checked');        
      $(this).siblings('.vendor-rate-4').removeClass('checked');        
      $(this).siblings('.vendor-rate-5').removeClass('checked');        
      $(this).parent().attr('user-rating','1');      
      //update_user_rating(1, vendor_id, user_id);
    }  
  });
  
  $(document).on('click', '.vendor-rate-2', function (e) {  
    e.stopImmediatePropagation();
    has_rating = true;
    var user_id = $(this).parent().attr('user-id');      
    var vendor_id = $(this).parent().attr('data-id');      
    //console.log('vendor_id',vendor_id,'user_id',user_id);
    if($(this).hasClass('checked')) {
      $(this).removeClass('checked');
      $(this).siblings('.vendor-rate-3').removeClass('checked');        
      $(this).siblings('.vendor-rate-4').removeClass('checked');        
      $(this).siblings('.vendor-rate-5').removeClass('checked');        
      $(this).parent().attr('user-rating','1');      
      //update_user_rating(1, vendor_id, user_id);
    } else { 
      $(this).siblings('.vendor-rate-1').addClass('checked');  
      $(this).addClass('checked');  
      $(this).siblings('.vendor-rate-3').removeClass('checked');        
      $(this).siblings('.vendor-rate-4').removeClass('checked');        
      $(this).siblings('.vendor-rate-5').removeClass('checked');        
      $(this).parent().attr('user-rating','2');      
      //update_user_rating(2, vendor_id, user_id);
    }  
  });
  
  $(document).on('click', '.vendor-rate-3', function (e) {  
    e.stopImmediatePropagation();
    has_rating = true;
    var user_id = $(this).parent().attr('user-id');      
    var vendor_id = $(this).parent().attr('data-id');      
    //console.log('vendor_id',vendor_id,'user_id',user_id);
    if($(this).hasClass('checked')) {
      $(this).removeClass('checked');
      $(this).siblings('.vendor-rate-4').removeClass('checked');        
      $(this).siblings('.vendor-rate-5').removeClass('checked');        
      $(this).parent().attr('user-rating','2');      
      //update_user_rating(2, vendor_id, user_id);
    } else { 
      $(this).siblings('.vendor-rate-1').addClass('checked');  
      $(this).siblings('.vendor-rate-2').addClass('checked');  
      $(this).addClass('checked');  
      $(this).siblings('.vendor-rate-4').removeClass('checked');        
      $(this).siblings('.vendor-rate-5').removeClass('checked');        
      $(this).parent().attr('user-rating','3');      
      //update_user_rating(3, vendor_id, user_id);
    }  
  });
  
  $(document).on('click', '.vendor-rate-4', function (e) {  
    e.stopImmediatePropagation();
    has_rating = true;
    var user_id = $(this).parent().attr('user-id');      
    var vendor_id = $(this).parent().attr('data-id');      
    //console.log('vendor_id',vendor_id,'user_id',user_id);
    if($(this).hasClass('checked')) {
      $(this).removeClass('checked');
      $(this).siblings('.vendor-rate-5').removeClass('checked');        
      //update_user_rating(3, vendor_id, user_id);
      $(this).parent().attr('user-rating','3');      
    } else { 
      $(this).siblings('.vendor-rate-1').addClass('checked');  
      $(this).siblings('.vendor-rate-2').addClass('checked');  
      $(this).siblings('.vendor-rate-3').addClass('checked');  
      $(this).addClass('checked');  
      $(this).siblings('.vendor-rate-5').removeClass('checked');        
      $(this).parent().attr('user-rating','4');      
      //update_user_rating(4, vendor_id, user_id);
    }  
  });
  
  $(document).on('click', '.vendor-rate-5', function (e) {  
    e.stopImmediatePropagation();
    has_rating = true;
    var user_id = $(this).parent().attr('user-id');      
    var vendor_id = $(this).parent().attr('data-id');      
    //console.log('vendor_id',vendor_id,'user_id',user_id);
    if($(this).hasClass('checked')) {
      $(this).removeClass('checked');
      //update_user_rating(4, vendor_id, user_id);
      $(this).parent().attr('user-rating','4');      
    } else { 
      $(this).siblings('.vendor-rate-1').addClass('checked');  
      $(this).siblings('.vendor-rate-2').addClass('checked');  
      $(this).siblings('.vendor-rate-3').addClass('checked');  
      $(this).siblings('.vendor-rate-4').addClass('checked');  
      $(this).addClass('checked');        
      $(this).parent().attr('user-rating','5');      
      //update_user_rating(5, vendor_id, user_id);
    }  
  });
  
  function update_user_rating(user_rating, vendor_id, user_id) {
    
    $('#ajaxloader').show();
    has_rating = true;
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
  
  $(document).on('click', '#submit-review', function (e) {  
    e.stopImmediatePropagation();
   
    var vendor_user_review = $('#vendor-user-review').val();
    
    vendor_user_review = vendor_user_review.trim();
    
    if(!has_rating) {
      alert('Please selectt a star rating before submitting a review.');
      return false;
    }  
    
      var user_rating = $('#edit-rating').attr('user-rating');
    
    if(vendor_user_review.length < 1)
      return false;
    
    $('#ajaxloader').show();
    $.ajax({
      'type' : 'GET',
      'url' : '$ajax_review',
      'dataType' : 'html',
      'data' : {
        'cguid' : '$container_guid',
        '$csrf_param' : '$csrf_token',
        'vendor_user_review' : vendor_user_review,  
        'user_rating' : user_rating,
        'vendor_id' : $vendor_id,
        'user_id' : $user_id
      },
      'success' : function(data){
        $('#ajaxloader').hide();
        window.location.reload(true)
      }
    });
    
  });


");
?>
  


