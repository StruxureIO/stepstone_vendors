<?php

use yii\helpers\Url;
use humhub\modules\stepstone_vendors\helpers\VendorsEntry;
use humhub\modules\content\helpers\ContentContainerHelper;

//include "protected/modules/stepstone_vendors/helpers/VendorsEntry.php";

$container = ContentContainerHelper::getCurrent();

if($container != null)
//  $detail_url = $container->createUrl('/stepstone_vendors/vendors/rate-vendor');
    $detail_url = $container->createUrl('/stepstone_vendors/vendors/detail');
else
  $detail_url = '';

if(strpos($detail_url, '?') !== false)
  $idparam = "&id=";
else
  $idparam = "?id=";

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

    //$vendor_rating = VendorsEntry::display_vendor_rating($vendor['vendor_rating'], $vendor['user_rating'], $vendor['id'], $user_id);
    $vendor_rating = VendorsEntry::display_vendor_rating($vendor['vendor_rating']);

    $html .= '    <tr vendor-id="'.$vendor['id'].'">' . PHP_EOL;
    $html .= '      <td><a href="'.$detail_url .  $idparam . $vendor['id'] .'">' . $vendor['vendor_name'] . '</a></td>' . PHP_EOL;
    $html .= '      <td>' . VendorsEntry::getVendorAreas($vendor['id']) . '</td>' . PHP_EOL;
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

if(isset($vendor)) {

switch($title_text) {
  case 'all-vendors':
    $title = 'All Vendors';
    break;

  case 'area-search':
    $area_name = VendorsEntry::getAreaName($vendor['area_id']);
    $title = "All $area_name Vendors";
    break;

  case 'type-search':
    $title = "All " . $vendor['type_name'];
    break;

  case 'subtype-search':
    $title = "All " . $vendor['subtype_name'];
    break;

  case 'area-type-search':
    $area_name = VendorsEntry::getAreaName($vendor['area_id']);
    $title = "All $area_name " . $vendor['type_name'];
    break;

  case 'area-subtype-search':
    $area_name = VendorsEntry::getAreaName($vendor['area_id']);
    $title = "All $area_name " . $vendor['subtype_name'];
    break;
}

} else {
  $title = '';
}

$data = array('html' => $html, 'title' => $title );
echo json_encode($data);

die();
