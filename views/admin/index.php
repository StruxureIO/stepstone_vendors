<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use humhub\modules\stepstone_vendors\helpers\VendorsEntry;


\humhub\modules\stepstone_vendors\assets\Assets::register($this);

$this->title = 'Vendors';
$this->params['breadcrumbs'][] = $this->title;

?>

  <div class="panel panel-default">
    <div class="panel-heading"><strong>Vendors</strong> </div>
        
    <div class="panel-body">
      
      <?php  echo $this->render('_vendorsearch', ['model' => $searchModel]); ?>
    
<!--        <p id="tag-button-row">
            < ?= Html::a('Add Vendor', ['add'], ['class' => 'btn btn-default']) ?>
        </p>-->
        
          <div id="vendors-grid-container">
            
          <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'filterModel' => $searchModel,
              'tableOptions' => ['class' => 'table'],
              'summary'=>'',
              'showFooter'=>false,
              'showHeader' => false,        
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                    'vendor_name',
                    'vendor_contact',
                    [
                      'label' => 'Areas',
                      'value' => function ($model) {
                          return VendorsEntry::getVendorAreas($model->id);
                      }
                    ],
                  ['class' => 'yii\grid\ActionColumn',
                      'buttons' => [
                        'delete' => function($url, $model, $key) {
                          return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $key], ['title' => 'Delete', 'class' => '', 'data' => ['confirm' => 'Are you sure you want to delete ' . $model->vendor_name . '?', 'method' => 'post', 'data-pjax' => false],]);
                        }],                                                                
                    'template'=>'{update} {delete}',
                  ],
                            
              ],
          ]); ?>

          </div>
        
    </div>

  </div>