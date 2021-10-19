<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

\humhub\modules\stepstone_vendors\assets\Assets::register($this);

?>

<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading"><strong>Vendor</strong> Areas</div>
    
    <div class="panel-body">
    

      <?php  echo $this->render('_areasearch', ['model' => $searchModel]); ?>
    
          <p id="tag-button-row">
              <?= Html::a('Add Vendor Area', ['add-area'], ['class' => 'btn btn-default']) ?>
          </p>
          
          <div id="video-grid-container">
            
          <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'filterModel' => $searchModel,
              'tableOptions' => ['class' => 'table'],
              'summary'=>'',
              //'filterUrl' => 'admin/vendortypes',
              //'filterUrl' => ['admin','vendortypes'],
              'filterUrl' => 'vendorarea',
              'showFooter'=>false,
              'showHeader' => false,        
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                    'area_name',                  
                  ['class' => 'yii\grid\ActionColumn',
                      'buttons' => [
                        'update'=>function($url,$model,$key)
                        {
                            if (Yii::$app->urlManager->enablePrettyUrl)
                              return Html::a( '<span class="glyphicon glyphicon-pencil"></span>' , Url::to("updatearea?id=$key")); 
                            else
                              return Html::a( '<span class="glyphicon glyphicon-pencil"></span>' , Url::to("index.php?r=stepstone_vendors/admin/updatearea&id=$key")); 
                        },
                        'delete'=>function($url,$model,$key)
                        {
                            if (Yii::$app->urlManager->enablePrettyUrl)
                              return Html::a( '<span class="glyphicon glyphicon-trash"></span>' , Url::to("delete-area?id=$key") ); //use Url::to() in order to change $url
                            else
                              return Html::a( '<span class="glyphicon glyphicon-trash"></span>' , Url::to("index.php?r=stepstone_vendors/admin/delete-area&id=$key") ); //use Url::to() in order to change $url
                        }],                                        
                    'template'=>'{update} {delete}',
                  ],
              ],
          ]); ?>

          </div>
    
    </div>
  </div>
</div>
      
