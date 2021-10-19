<?php

use yii\helpers\Url;
use humhub\modules\stepstone_vendors\helpers\VendorsEntry;

//include "protected/modules/stepstone_vendors/helpers/VendorsEntry.php";

$current_vendor_type = 0;
$first = true;
$html = '';

//$html .= "<p>$sql</p>";

if($vendors) {
  $html .= '<table id="vendors-table">' . PHP_EOL; 
             
  foreach($vendors as $vendor) {
    
    if($vendor['vendor_type'] != $current_vendor_type) {
      if(!$first) 
        $html .= '  </tbody>' . PHP_EOL; 
      else
        $first = false;
      
      $html .= VendorsEntry::display_vender_thead($vendor['type_name']);    
      $current_vendor_type = $vendor['vendor_type'];
      $html .= '  <tbody>' . PHP_EOL; 
    }
    
    $contact_info = VendorsEntry::contact_info($vendor['vendor_contact'], $vendor['vendor_phone'], $vendor['vendor_email'] );
    
    $vendor_rating = VendorsEntry::display_vendor_rating($vendor['vendor_rating'], $vendor['user_rating'], $vendor['id'], $user_id);
    
    $html .= '    <tr vendor-id="'.$vendor['id'].'">' . PHP_EOL; 
    $html .= '      <td>' . $vendor['vendor_name'] . '</td>' . PHP_EOL;
    //$html .= '      <td>' . $vendor['vendor_area'] . '</td>' . PHP_EOL;
    $html .= '      <td></td>' . PHP_EOL;
    $html .= '      <td>' . $contact_info . '</td>' . PHP_EOL;
    $html .= '      <td>' . trim($vendor['firstname'] . ' ' . $vendor['lastname']) . '</td>' . PHP_EOL;
    $html .= '      <td>' . $vendor_rating . '</td>' . PHP_EOL;
    $html .= '    </tr>' . PHP_EOL; 
  }
  
  $html .= '</table>' . PHP_EOL; 
  
  $html .= '<div style="clear:both"></div>' . PHP_EOL;
  
  $html .= '<div id="vendors-page-navigation">' . PHP_EOL;
  if($page > 0)
    $html .= '  <a id="step-vendors-prev" data-page-id="'. ($page-1) .'" data-search-text="'.$search_text.'">< Previous</a>' . PHP_EOL;
  if($page < $total_number_pages-1)
    $html .= '  <a id="step-vendors-next" data-page-id="'. ($page+1) .'" data-search-text="'.$search_text.'">Next ></a>' . PHP_EOL;
  $html .= '</div>' . PHP_EOL;
  
} else {
  $html = '<p id="no-vendors-founds">No vendors found</p>';  
}

$data = array('html' => $html);
echo json_encode($data);

die();
