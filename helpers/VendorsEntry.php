<?php

namespace humhub\modules\stepstone_vendors\helpers;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UrlManager;

class VendorsEntry {  
  
  public static function display_vender_thead($type_name) {
    
    $html = '  <thead>' . PHP_EOL; 
    $html .= '    <tr class="vendor-heading">' . PHP_EOL; 
    $html .= '      <td>'.$type_name.'</td>' . PHP_EOL; 
    $html .= '      <td>Area</td>' . PHP_EOL; 
    $html .= '      <td>Contact Info</td>' . PHP_EOL; 
    $html .= '      <td>Recommended by</td>' . PHP_EOL; 
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
      $contact_info .= $vendor_email;
    
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
    
    $rating_stars = '<span><span class="'.$check1.'" rate-id="1" ><span class="fa fa-star "></span></span><span class="'.$check2.'" rate-id="2" ><span class="fa fa-star "></span></span><span class="'.$check3.'" rate-id="3" ><span class="fa fa-star "></span></span><span class="'.$check4.'" rate-id="4" ><span class="fa fa-star "></span></span><span class="'.$check5.'" rate-id="5" ><span class="fa fa-star "></span></span>';
        
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
  
  public static function vendorDetailHeader($vendor, $subtypes, $profile) {
    
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
      $contact_info .= $vendor->vendor_email . '<br>';
    
    
    ?>
    <div id="vendor-header">
      <div id="header-top">
        <h1 id="vendor_name"><?php echo $vendor->vendor_name ?></h1><span id="vendor_subtype"><?php echo $subtypes->subtype_name ?></span>
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
  
  public static function vendorMenu($id, $detail_url, $vendor_rate_url, $vendor_url, $edit_vendor_url, $vendor_recommended_user_id) {
    
    if (\Yii::$app->urlManager->enablePrettyUrl) 
      $id_param = "?id=";
    else
      $id_param = "&id=";
    
    $current_user_id = \Yii::$app->user->identity->ID;
    
    ?>
      <div id="vendor-menu">
        <p><strong>Vendor Menu</strong></p>
        <ul id="vendor-menu-list">
          <li><a href="<?php echo $detail_url . $id_param . $id ?>"><i class="fas fa-list"></i></i> Stream</a></li>
          <li><a href="<?php echo $vendor_rate_url . $id_param . $id ?>"><i class="fas fa-star-half-alt"></i> Ratings</a></li>
          <?php if($vendor_recommended_user_id == $current_user_id) { ?> 
            <li><a href="<?php echo $edit_vendor_url . $id_param . $id ?>"><i class="fas fa-edit"></i> Edit Vendor</a></li>
          <?php } ?>  
          <li><a href="<?php echo $vendor_url ?>"><i class="far fa-address-book"></i> Vendors</a></li>
        </ul>        
      </div>  
    <?php
  }
  
  public static function latestRatings($ratings) {
    
    ?>
      <p><strong>Latest Ratings</strong></p>
      <ul id="vendor-menu-list">
        <?php 
          foreach($ratings as $rating) {
            $name = '';
            if(!empty($rating['firstname']))
              $name .= $rating['firstname'] . " "; 
            if(!empty($rating['lastname']))
              $name .= $rating['lastname']; 
            $date = date("m/d/Y", strtotime($rating['rating_date']));
            echo "<li>" . PHP_EOL;
            echo "  <div>" . VendorsEntry::display_vendor_rating($rating['user_rating']) .  "</div>". PHP_EOL;
            echo "  <div> <span class='rator-name'>" . $name . " <span class='rating-date'>($date)</span></div>". PHP_EOL;
            echo "</li>" . PHP_EOL;
          }
        ?>
        <li></li>
        <li></li>
      </ul>

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
  
    
}


