<?php

use humhub\libs\Html;
use humhub\widgets\PanelMenu;
use humhub\modules\ui\view\components\View;
use yii\helpers\Url;
use yii\web\UrlManager;


?>

<div class="panel panel-default panel-vendors" id="panel-vendors">

    <style>

      #vendor-dashboard-title {
        float: left;
      }

      #vendors-widget {
        padding-left: 0px;
        margin-left: 0px;
      }

      ul#vendors-widget li {
        list-style: none;
        padding: 11px 15px;
      }

      .vendor-list-left {
        float: left;
        text-align: center;
        text-align: -moz-center;
      }

      .vendor-list-right {
        float: left;
        padding-left: 10px;
      }

      .vendor-name {
        font-size: 14px;
        font-weight: 700;
        color: black;
      }

      .vendor-type {
        font-size: 10px;
      }

      a.new-vendor-link {
        cursor: pointer;
        display: block;
      }

      #vendor-dashboard-title {
        float: left;
      }

      #vendor-locations {
        background-color: #fff;
        float: right;
        font-size: 12px;
        margin-right: 20px;
      }

      #user-profile-link {
        font-size: 12px;
        color: #78BE20;
        margin-left: 10px;
      }

      #panel-vendors .panel-body {
        padding:0px;
        margin:0px;
      }


    </style>

    <?= PanelMenu::widget(['id' => 'panel-vendor']); ?>

    <div style="clear:both;"></div>

    <div class="panel-heading">
      <span id="vendor-dashboard-title">
        <strong>New</strong>&nbsp;vendors
        </span> 
        <a href="<?php echo Url::base() ?>/user/account/edit" id="user-profile-link">Change Location</a>
<!--      <select id="vendor-locations">
        <option value="0">Filter by location</option>
        < ?php
        foreach($areas as $area) {
          echo "<option value='{$area['area_id']}'>{$area['area_name']}</option>". PHP_EOL;

        }
        ?>
      </select>-->
    </div>
    <div class="panel-body">
      <ul id="vendors-widget" class="media-list activities">
        <?php if($vendors) { ?>
          <?php foreach($vendors as $vendor) { ?>
            <?php
              $icon = '';
              $vendor_type = '';

              if (\Yii::$app->urlManager->enablePrettyUrl)
                $vendor_link = Url::base() . "/s/welcome-space/stepstone_vendors/vendors/detail?id=" . $vendor['id'];
              else
                $watch_link = Url::base() ."/index.php?r=stepstone_vendors%2Findex%2Fvendors&id=" . $vendor['id'];

              if($vendor['subicon'] != null)
                $icon = $vendor['subicon'];
              else
                $icon = $vendor['type_icon'];

              if($vendor['subtype_name'] !=null)
                $vendor_type = $vendor['subtype_name'];
              else
                $vendor_type = $vendor['type_name'];

            ?>
            <li class="activity-entry">
              <a href="<?php echo $vendor_link; /*$vendor_link*/ ?>" class="new-vendor-link">
                <div class="vendor-list-left">
                  <i class="<?php echo $icon ?>"></i>
                </div>
                <div class="vendor-list-right">
                  <div class="vendor-name"><?php echo $vendor['vendor_name'] ?></div>
                  <div class="vendor-type"><?php echo $vendor_type ?></div>
                </div>
                <div style="clear:both;"></div>
              </a>
            </li>
          <?php } ?>
        <?php } ?>
      </ul>
    </div>
</div>
