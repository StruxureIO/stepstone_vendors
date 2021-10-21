<?php

namespace humhub\modules\stepstone_vendors\controllers;

use humhub\components\Controller;
//use humhub\modules\stepstone_vendors\models;
use Yii;
use yii\helpers\ArrayHelper;
use humhub\modules\stepstone_vendors\models\Vendors;
use humhub\modules\stepstone_vendors\models\VendorTypes;
use humhub\modules\stepstone_vendors\models\VendorsRatings;

//include "protected/modules/vendors/models/Vendors.php";
//include_once "protected/modules/vendors/models/VendorTypes.php";
//include "protected/modules/vendors/models/VendorsRatings.php";

class IndexController extends Controller {
  
  public $mTypes;
  public $mVendors;
  public $mUsers;
  public $mRatings;
    
  public $subLayout = "@stepstone_vendors/views/layouts/default";

  public function actionIndex(){
                    
    return $this->render('index');
    
  }
  
  public function actionAjaxView() {
    
    //Yii::$app->cache->flush();
    
    $search_condition = '';
    
    $req = Yii::$app->request;
    
    $search_text = trim($req->get('search_text', ''));
        
    $page = $req->get('page', 0);    
    
    $vendor_ids = $req->get('vendor_ids', '');
    
    $vendor_ids = str_replace('"', '', $vendor_ids);    
    
    $user_id = \Yii::$app->user->identity->ID;
        
    if($search_text != '')
      $search_condition = " vendor_name like '%$search_text%' or vendor_contact like '%$search_text%' ";
        
    if(!empty($vendor_ids)) {
      $where = " WHERE v.vendor_type IN ($vendor_ids) ";
      if($search_text != '')
        $where .= " and ( $search_condition ) ";
    } else {
      if($search_text != '')
        $where = " where $search_condition ";    
      else
        $where = "";    
    }  
       
    $connection = Yii::$app->getDb();
    
    $command = $connection->createCommand("select count(id) from vendors as v $where");
        
    $count = $command->queryOne();
    
    $offset = $page * MAX_VENDOR_ITEMS;
    $total_number_pages = ceil($count['count(id)'] / MAX_VENDOR_ITEMS);        
        
    $command = $connection->createCommand("select v.*, t.type_name, p.firstname, p.lastname, r.user_rating  
from vendors as v
LEFT JOIN vendor_types as t on t.type_id = v.vendor_type 
LEFT JOIN profile as p on p.user_id = v.vendor_recommended_user_id 
LEFT JOIN vendors_ratings as r on r.vendor_id = v.id 
$where group by v.id order by t.type_name, vendor_name limit $offset, " . MAX_VENDOR_ITEMS);
          
    $sql = $command->sql;
    
    $vendors = $command->queryAll();   
    
    return $this->renderPartial('_view', [
      'vendors' => $vendors,
      'page' => $page,
      'user_id' => $user_id,
      'total_number_pages' => $total_number_pages,
      'search_text' => $search_text,
      'sql' => $sql,  
    ]);   
    
  }
  
  public function actionAdd() {
    
    //Yii::$app->cache->flush();
    $current_user_id = \Yii::$app->user->identity->ID;
        
    $model = new \humhub\modules\stepstone_vendors\models\Vendors();
    $this->mTypes = new \humhub\modules\stepstone_vendors\models\VendorTypes();
    $types = ArrayHelper::map($this->mTypes::find()->all(),'type_id','type_name');

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
      $model->vendorAdded();      
      return $this->redirect(['index/index']);
    }

    return $this->render('add', [
      'model' => $model, 
      'types' => $types,
      'user' => array(), 
      'current_user_id' => $current_user_id,
    ]);
        
  }
  
  public function actionAjaxRating() {
    
    $total_rating = 0;
    
    $req = Yii::$app->request;
    
    $user_rating = $req->get('user_rating', 0);    
    
    $vendor_id = $req->get('vendor_id', 0);
    
    $user_id = $req->get('user_id', 0);
    
    $this->mRatings = new \humhub\modules\stepstone_vendors\models\VendorsRatings();
    $model = $this->mRatings::find()->where(['vendor_id' => $vendor_id, 'user_id' => $user_id])->one();
    
    if($model) {
      $model->user_rating = $user_rating;
      $model->save();      
    } else {
      $model = new \humhub\modules\stepstone_vendors\models\VendorsRatings();
      $model->vendor_id = $vendor_id;
      $model->user_id = $user_id;
      $model->user_rating = $user_rating;            
      $model->save();      
    }    
    
    $connection = Yii::$app->getDb();
    
    $command = $connection->createCommand("SELECT AVG(user_rating) as 'vendor_rating' FROM  vendors_ratings WHERE vendor_id = $vendor_id");
          
    $rating = $command->queryAll();   
    var_dump($rating);
    
    if($rating) {
      $total_rating = intval(ceil($rating[0]['vendor_rating']));    
      
      $mVendors = new \humhub\modules\stepstone_vendors\models\Vendors();
      $vendors = $mVendors::find()->where(['id' => $vendor_id])->one();
      
      if($vendors) {
        $vendors->vendor_rating = $total_rating;
        $vendors->save();
      }
      
    }
                
    echo $total_rating;
    
    die();
    
  }
  
}

