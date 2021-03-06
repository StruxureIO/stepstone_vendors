<?php

namespace humhub\modules\stepstone_vendors\helpers;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UrlManager;
use humhub\modules\content\helpers\ContentContainerHelper;

class VendorsEntry {  
  
  public static function display_vender_thead($type_name) {
    
    $html = '  <thead>' . PHP_EOL; 
    $html .= '    <tr class="vendor-heading">' . PHP_EOL; 
    $html .= '      <td>'.$type_name.'</td>' . PHP_EOL; 
    $html .= '      <td>Contact Info</td>' . PHP_EOL; 
    $html .= '      <td>Area</td>' . PHP_EOL; 
    $html .= '      <td>Rating</td>' . PHP_EOL; 
    $html .= '    </tr>' . PHP_EOL; 
    $html .= '  </thead>' . PHP_EOL; 
    
    return $html;
    
  }
  
  public static function contact_info($vendor_contact, $vendor_phone, $vendor_email) {
    
    $contact_info = '';
    
    if(!empty($vendor_contact))
      $contact_info .= $vendor_contact . '<br>';
    
    if(!empty($vendor_phone))
      $contact_info .= $vendor_phone . '<br>';
    
    if(!empty($vendor_email))
      $contact_info .= '<a class="mail-to-link" href="mailto:'.$vendor_email.'">' . $vendor_email . '</a>';
    
    return $contact_info;
    
  }
  
  public static function display_vendor_rating($vendor_rating) {
    
    $rating_stars = '';
    
    $check1 = '';
    $check2 = '';
    $check3 = '';
    $check4 = '';
    $check5 = '';
    
    if(is_null($vendor_rating))
      $vendor_rating = 0;
        
    switch($vendor_rating) {
      
      case 1:
        $check1 = 'checked';
        break;
      
      case 2:
        $check1 = 'checked';
        $check2 = 'checked';
        break;
      
      case 3:
        $check1 = 'checked';
        $check2 = 'checked';
        $check3 = 'checked';
        break;
      
      case 4:
        $check1 = 'checked';
        $check2 = 'checked';
        $check3 = 'checked';
        $check4 = 'checked';
        break;
      
      case 5:
        $check1 = 'checked';
        $check2 = 'checked';
        $check3 = 'checked';
        $check4 = 'checked';
        $check5 = 'checked';
        break;      
            
      case 0:
      default:  
        break;
      
    }
    
    $rating_stars = '<span class="vendor-rating-stars"><span class="'.$check1.'" rate-id="1" ><span class="fa fa-star "></span></span><span class="'.$check2.'" rate-id="2" ><span class="fa fa-star "></span></span><span class="'.$check3.'" rate-id="3" ><span class="fa fa-star "></span></span><span class="'.$check4.'" rate-id="4" ><span class="fa fa-star "></span></span><span class="'.$check5.'" rate-id="5" ><span class="fa fa-star "></span></span>';
        
    return $rating_stars;
        
  }
  
  public static function display_vendor_user_rating($user_rating, $vendor_id, $user_id) {
    
    $rating_stars = '';
    
    $check1 = '';
    $check2 = '';
    $check3 = '';
    $check4 = '';
    $check5 = '';
    
    
    if(is_null($user_rating))
      $user_rating = 0;
    
    switch($user_rating) {
      
      case 1:
        $check1 = 'checked';
        break;
      
      case 2:
        $check1 = 'checked';
        $check2 = 'checked';
        break;
      
      case 3:
        $check1 = 'checked';
        $check2 = 'checked';
        $check3 = 'checked';
        break;
      
      case 4:
        $check1 = 'checked';
        $check2 = 'checked';
        $check3 = 'checked';
        $check4 = 'checked';
        break;
      
      case 5:
        $check1 = 'checked';
        $check2 = 'checked';
        $check3 = 'checked';
        $check4 = 'checked';
        $check5 = 'checked';
        break;      
            
      case 0:
      default:  
        break;
      
    }
    
    $rating_stars = '<span id="edit-rating" data-id="'.$vendor_id.'" user-id="'.$user_id.'" user-rating="'. $user_rating .'"><a class="vendor-rate-1 '.$check1.'" rate-id="1" ><span class="fa fa-star "></span></a><a class="vendor-rate-2 '.$check2.'" rate-id="2" ><span class="fa fa-star "></span></a><a class="vendor-rate-3 '.$check3.'" rate-id="3" ><span class="fa fa-star "></span></a><a class="vendor-rate-4 '.$check4.'" rate-id="4" ><span class="fa fa-star "></span></a><a class="vendor-rate-5 '.$check5.'" rate-id="5" ><span class="fa fa-star "></span></a>';
      
    return $rating_stars;
        
  }
    
  public static function getSubTypes($type_id) {
     
    $subtypes = array();
     
    $connection = Yii::$app->getDb();
    $command = $connection->createCommand("select subtype_id, subtype_name, icon from vendor_sub_type where type_id = $type_id order by subtype_name");
    $subtypes = $command->queryAll();   
         
    return $subtypes;
  }
  
  public static function vendorDetailHeader($vendor, $subtypes, $profile, $type) {
    
    if(!empty($profile['firstname']))
      $firstname = $profile['firstname'];
    else
      $firstname = '';

    if(!empty($profile['lastname']))
      $lastname = $profile['lastname'];
    else
      $lastname = '';
    
    $vendor_rating = VendorsEntry::display_vendor_rating($vendor['vendor_rating']);
    
    $contact_info = '';
    if(!empty($vendor->vendor_contact))
      $contact_info .= $vendor->vendor_contact . '<br>';
    if(!empty($vendor->vendor_phone))
      $contact_info .= $vendor->vendor_phone . '<br>';
    if(!empty($vendor->vendor_email))
      $contact_info .= '<a href="mailto:' . $vendor->vendor_email.'">'.$vendor->vendor_email . '</a><br>';
    
    
    ?>


  <div id="vendor-header" class="panel-profile-header">

    <div id="header-top" class="image-upload-container profile-banner-image-container">
       <?php
          if(isset($subtypes->subtype_name))
            $subtype_name = $subtypes->subtype_name;
          else 
            $subtype_name = $type->type_name;
        ?>
        <!-- profile image output-->
        <img class="img-vendor-header-background" src="/themes/TheBlackSheepHubTheme/img/default_banner.jpg" alt="" style="width:100%;">
        <!-- show user name and title -->
        <div class="img-vendor-data">
          <h1 class="profile" id="vendor_name"><?php echo $vendor->vendor_name ?></h1>            
          <span class="profile" id="vendor_subtype"><?php echo $subtype_name ?></span>
        </div>
    </div>
      
      <div id="header-bottom">
        <table id="vendor-info">
          <thead id="vendor-titles">
            <tr>
              <td class="vendor-area">Areas</td>
              <td class="vendor-contact">Contact Info</td>
              <td class="vendor-contributor">Listed By</td>
              <td class="vendor-rating">Rating</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="vendor-area"><?php echo VendorsEntry::getVendorAreas($vendor->id) ?></td>
              <td class="vendor-contact"><?php echo $contact_info ?></td>
              <td class="vendor-contributor"><?php echo $firstname . " " . $lastname ?></td>
              <td class="vendor-rating"><?php echo $vendor_rating ?></td>
            </tr>            
          </tbody>
        </table>
      </div>
    </div>

    <?php    
  }
  
  public static function vendorMenu($id, $detail_url, $vendor_rate_url, $vendor_url, $edit_vendor_url, $vendor_recommended_user_id, $area = 1) {
    
    if (\Yii::$app->urlManager->enablePrettyUrl) 
      $id_param = "?id=";
    else
      $id_param = "&id=";
    
    $current_user_id = \Yii::$app->user->identity->ID;
    
    ?>
      <div id="vendor-menu" class="panel panel-default left-navigation">
      <div class="panel-heading"><strong>Vendor</strong>&nbsp;menu</div>
        <div id="vendor-menu-list" class="list-group">

          <a class="list-group-item" href="<?php echo $detail_url . $id_param . $id . "&area=" . $area ?>"><i class="fas fa-list"></i></i> Stream</a>
          <a class="list-group-item" href="<?php echo $vendor_rate_url . $id_param . $id . "&area=" . $area ?>"><i class="fas fa-star-half-alt"></i> Ratings</a>
          <?php if($vendor_recommended_user_id == $current_user_id) { ?> 
            <li><a class="list-group-item" href="<?php echo $edit_vendor_url . $id_param . $id . "&area=" . $area ?>"><i class="fas fa-edit"></i> Edit Vendor</a>
          <?php } ?>  
          <a class="list-group-item" href="<?php echo $vendor_url ?>"><i class="far fa-address-book"></i> Vendors</a></li>
          </div>        
      </div>  

      <script>
        // Set active current menu item
        $(function() {
          $('#vendor-menu-list a').removeClass('active');
          $('#vendor-menu-list a[href^="' + location.pathname + '"]').addClass('active');
        });
      </script>
      
    <?php




  }
  
  
  public static function latestRatings($ratings) {
    
    ?>
      <div class="panel-heading"><strong>Latest</strong>&nbsp;ratings</div>
        <div class="panel-body">
          <?php 
            foreach($ratings as $rating) {
              $name = '';
              if(!empty($rating['firstname']))
                $name .= $rating['firstname'] . " "; 
              if(!empty($rating['lastname']))
                $name .= $rating['lastname']; 
              $date = date("m/d/Y", strtotime($rating['rating_date']));
              echo "  <div>" . VendorsEntry::display_vendor_rating($rating['user_rating']) .  "</div>". PHP_EOL;
              echo "  <div> <span class='rator-name'>" . $name . " <span class='rating-date'>($date)</span></div>". PHP_EOL;
            }
          ?>
       </div> <!-- <panel-content -->
     

    <?php
  
  }
  
  public static function getVendorAreas($vendor_id) {
    
    $areas = array();
    $vendor_areas = '';
    $first = true;
     
    $connection = Yii::$app->getDb();
    $command = $connection->createCommand("SELECT vendor_areas.area_name FROM vendor_area_list LEFT JOIN `vendor_areas` ON vendor_areas.area_id = vendor_area_list.area_id WHERE vendor_id = $vendor_id");
    $areas = $command->queryAll();   
    
    foreach($areas as $area) {
      if($first) {
        $vendor_areas .= $area['area_name'];
        $first = false;
      } else {
        $vendor_areas .= ', ' . $area['area_name'];
      }            
    }  
    
    return $vendor_areas;
  }
  
  public static function getAreaName($area_id) {
    
    $connection = Yii::$app->getDb();
    $command = $connection->createCommand("Select area_name from vendor_areas where area_id = $area_id");    
    $area = $command->queryOne();
    
    if(isset($area['area_name']))
      return $area['area_name'];
    else
      return '';
    
  }
  
  public static function similarVendors($subtype, $area, $current_vendor, $vendor_type) {
    
    $container = ContentContainerHelper::getCurrent();
    
    if(empty($area) || $area == 0)
      $area = 0;
    
    if($container != null)
      $detail_url = $container->createUrl('/stepstone_vendors/vendors/detail');
    else
      $detail_url = '';

    if(strpos($detail_url, '?') !== false)
      $idparam = "&id=";
    else
      $idparam = "?id=";
    
    $connection = Yii::$app->getDb();
    
    if($area == '0') { 
      $location_join = '';
      $area_where = '';
    } else {
      $location_join = 'LEFT JOIN vendor_area_list as l on l.vendor_id = v.id';
      $area_where = "l.area_id = $area and";
    }  
    
    if(empty($subtype)) {
      
      $command = $connection->createCommand("select v.*
      from vendors as v 
      $location_join 
      where $area_where vendor_type = $vendor_type order by vendor_name");
            
    } else {
      
      $command = $connection->createCommand("select v.*
      from vendors as v 
      $location_join 
      where $area_where subtype = $subtype order by vendor_name");      
      
    }
    
    //$sql = $command->sql;
                
    $similar_vendors = $command->queryAll();
              
    ?>
      <div class="panel-heading">
        <strong>Similar</strong> vendors 
      </div>
      
        <?php 
          if($similar_vendors) {
            echo "<ul id='sim-vendor-list'>" . PHP_EOL;
            foreach($similar_vendors as $similar_vendor) {
              if($similar_vendor['id'] != $current_vendor)
                echo "<li><a href='" . $detail_url .  $idparam . $similar_vendor['id'] . '&area=' . $area ."'>" . $similar_vendor['vendor_name'] ."</a></li>" . PHP_EOL;
            }
            echo "</ul>" . PHP_EOL;
          }
        ?>  
      
      
    <?php  
    
  }
  
  
    
}


