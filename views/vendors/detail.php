<?php
use humhub\modules\stepstone_vendors\helpers\VendorsEntry;
use humhub\modules\post\widgets\Form;
use humhub\modules\stepstone_vendors\widgets\ContentInfoStreamFilterNavigation;
use humhub\modules\stream\widgets\StreamViewer;
use humhub\modules\content\helpers\ContentContainerHelper;


humhub\modules\stepstone_vendors\assets\Assets::register($this);

$container = ContentContainerHelper::getCurrent();

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

?>

<div class="container-fluid">

  <div class="panel panel-default">
        
    <?php VendorsEntry::vendorDetailHeader($vendor, $subtypes, $profile); ?>
    
  </div>    
  
  
  <div class="row">
    
    <div class="col-md-2"> 
      <?php VendorsEntry::vendorMenu($vendor->id, $detail_url, $vendor_rate_url, $vendor_url, $edit_vendor_url, $vendor->vendor_recommended_user_id) ?>
    </div>
    
    <div class="col-md-8"> 
        <?php 
          if (!Yii::$app->user->isGuest) {
              echo Form::widget(['contentContainer' => Yii::$app->user->getIdentity()]);
          }
                    
//          echo StreamViewer::widget([
//          'streamAction' => '/stepstone_vendors/stream/stream',
//          'streamFilterNavigation' => ContentInfoStreamFilterNavigation::class,
//          'messageStreamEmpty' => Yii::t('StepstoneVendorsModule.base', 'Sees there are no entries available, create some first to see this example work!'),
//          ])
          
          
          //'streamAction' => '//directory/directory/stream',
          //'streamAction' => '//stepstone_vendors/' . $stream_name .'/stream',

//          echo StreamViewer::widget([
//              'streamAction' => '//stepstone_vendors/vendors/stream',
//              'messageStreamEmpty' => (!Yii::$app->user->isGuest) ?
//                      Yii::t('DirectoryModule.base', '<b>Nobody has written anything yet.</b><br>Post to get things started...') :
//                      Yii::t('DirectoryModule.base', '<b>There are no profile posts yet!</b>'),
//              'messageStreamEmptyCss' => (!Yii::$app->user->isGuest) ?
//                      'placeholder-empty-stream' :
//                      '',
//          ]);
        
        ?>
    </div>
    
    <div class="col-md-2"> 
            
      <div id="latest-ratings">
        <?php VendorsEntry::latestRatings($latest_ratings) ?>        
      </div>
    </div>
    
    
    
    
  </div>  
  
</div>    
