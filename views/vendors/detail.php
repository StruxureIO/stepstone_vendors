<?php

use humhub\modules\content\components\ContentContainerController;
use humhub\modules\stepstone_vendors\components\OwnContentStreamFilter;
use humhub\modules\stepstone_vendors\widgets\VendorCommentsForm;
use humhub\modules\stepstone_vendors\helpers\VendorsEntry;
use humhub\modules\content\helpers\ContentContainerHelper;
use humhub\modules\stream\widgets\StreamViewer;


/**@var $contentContainer ContentContainerController */
/**@var $canCreatePosts boolean */
/**@var $vendor \humhub\modules\stepstone_vendors\models\VendorsContentContainer */

humhub\modules\stepstone_vendors\assets\Assets::register($this);

$container = ContentContainerHelper::getCurrent();

if ($container != null) {
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
            Yii::error(\yii\helpers\VarDumper::dumpAsString($vendor->id));
            if (!Yii::$app->user->isGuest) {
                echo VendorCommentsForm::widget([
                    'contentContainer' => $contentContainer,
                    'vendorId' => $vendor->id
                ]);
            }

            echo StreamViewer::widget([
                'contentContainer' => $contentContainer,
                'streamAction' => '/stepstone_vendors/vendors/stream',
                'messageStreamEmpty' => Yii::t('StepstoneVendorsModule.base', 'Sees there are no entries available, create some first to see this example work!'),
                'streamFilterNavigation' => false,
            ])
            ?>
        </div>

        <div class="col-md-2">

            <div id="latest-ratings">
                <?php VendorsEntry::latestRatings($latest_ratings) ?>
            </div>
        </div>


    </div>

</div>
