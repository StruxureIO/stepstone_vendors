<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

\humhub\modules\stepstone_vendors\assets\Assets::register($this);

?>

  <div class="panel panel-default">
    <div class="panel-heading"><strong>Vendor</strong> Types</div>
    
    <div class="panel-body">
    

      <?php  echo $this->render('_typesearch', ['model' => $searchModel]); ?>
    
          <p id="tag-button-row">
              <?= Html::a('Add Vendor Type', ['add-type'], ['class' => 'btn btn-default']) ?>
          </p>
          
          <div id="video-grid-container">
            
          <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'filterModel' => $searchModel,
              'tableOptions' => ['class' => 'table'],
              'summary'=>'',
              //'filterUrl' => 'admin/vendortypes',
              //'filterUrl' => ['admin','vendortypes'],
              'filterUrl' => 'vendortypes',
              'showFooter'=>false,
              'showHeader' => false,        
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                    'type_name',                  
                  ['class' => 'yii\grid\ActionColumn',
                      'buttons' => [
                        'update'=>function($url,$model,$key)
                        {
                            if (Yii::$app->urlManager->enablePrettyUrl)
                              return Html::a( '<span class="glyphicon glyphicon-pencil"></span>' , Url::to("updatetype?id=$key")); 
                            else
                              return Html::a( '<span class="glyphicon glyphicon-pencil"></span>' , Url::to("index.php?r=stepstone_vendors/admin/updatetype&id=$key")); 
                        },
                        'delete' => function($url, $model, $key) {
                          return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete-type', 'id' => $key], ['title' => 'Delete', 'class' => '', 'data' => ['confirm' => 'Are you sure you want to delete ' . $model->type_name  .'?', 'method' => 'post', 'data-pjax' => false],]);
                        }],                                                                
                    'template'=>'{update} {delete}',
                  ],
              ],
          ]); ?>

          </div>
    
    </div>
  </div>
