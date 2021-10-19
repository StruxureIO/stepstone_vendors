<?php

namespace humhub\modules\stepstone_vendors\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\stepstone_vendors\models;
use humhub\modules\stepstone_vendors\models\VendorSubTypes;
use humhub\modules\stepstone_vendors\models\VendorAreas;
use humhub\modules\stepstone_vendors\models\VendorAreaList;
use Yii;
use yii\helpers\ArrayHelper;

class AdminController extends Controller
{
  
  public $mTypes;
  public $mVendors;
  public $mUsers;
  public $mSubtypes;
  public $mAreas;
  public $mAreaList;
  
  public function accessRules() {

		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','vendortypes','savevendortypes','search'), 
				'users'=>array('*'),

			));
  }      
    
  public function actionIndex() {    
    //return $this->render('index');
    
    $searchModel = new \humhub\modules\stepstone_vendors\models\VendorsSearch();
    //$searchModel = new VendorsSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $dataProvider->sort->defaultOrder = ['vendor_name' => SORT_ASC];

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
            
  }
  
  public function actionVendortypes() {
    
    //return $this->render('vendortypes');
    
    $searchModel = new \humhub\modules\stepstone_vendors\models\TypesSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $dataProvider->sort->defaultOrder = ['type_name' => SORT_ASC];

    return $this->render('vendortypes', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
    
    
  }
  
  public function actionUpdatetype($id) {
    
    $this->mTypes = new \humhub\modules\stepstone_vendors\models\VendorTypes();
    //$this->mSubtypes = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();

    $model = $this->mTypes::find()->where(['type_id' => $id])->one();      

    if ($model->load(Yii::$app->request->post()) && $model->validate() &&  $model->save()) {
      return $this->redirect(['admin/vendortypes']);
    }

    return $this->render('updatetype', [
      'model' => $model,
    ]);           
    
  }
  
  public function actionAddType() {
    
    $model = new \humhub\modules\stepstone_vendors\models\VendorTypes();
    //$subtypes = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
      return $this->redirect(['admin/vendortypes']);
    }

    return $this->render('add-type', ['model' => $model]);
    
    
  }
  
  public function actionDeleteType($id) {

    $model = $this->findVenderTypeModel($id);
    $model->delete();

    return $this->redirect(['admin/vendortypes']);

  }

  protected function findVenderTypeModel($id){

    $mTypes = new \humhub\modules\stepstone_vendors\models\VendorTypes();

    if(($model = $mTypes::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }   

  public function actionUpdate($id) {
    
    //Yii::$app->cache->flush();
    
    $current_user_id = \Yii::$app->user->identity->ID;
               
    $this->mVendors = new \humhub\modules\stepstone_vendors\models\Vendors();
    $this->mTypes = new \humhub\modules\stepstone_vendors\models\VendorTypes();
    $this->mUsers = new \humhub\modules\user\models\User();
    $this->mSubtypes = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();
    $this->mAreas = new \humhub\modules\stepstone_vendors\models\VendorAreas();
    $this->mAreaList = new \humhub\modules\stepstone_vendors\models\VendorAreaList();

    $model = $this->mVendors::find()->where(['id' => $id])->one();      
    
    $types = ArrayHelper::map($this->mTypes::find()->all(),'type_id','type_name');
    
    $areas = $this->mAreas::find()->all();          
    
    $subtypes = ArrayHelper::map($this->mSubtypes::find()->where(['type_id' => $model->vendor_type])->all(), 'subtype_id', 'subtype_name');   
    
    $user = $this->mUsers::find()->where(['id' => $model->vendor_recommended_user_id])->one();      
    
    if ($model->load(Yii::$app->request->post())) {
            
      $model->updated_at = date('Y-m-d H:i:s');
      $model->updated_by = \Yii::$app->user->identity->ID;
                        
      if($model->validate() && $model->save()) {
        
        $this->mAreaList::deleteAll(['vendor_id' => $model->id]);
        $selected_areas = explode(',', $model->areas);      
        foreach($selected_areas as $area) {
          $new_area = new \humhub\modules\stepstone_vendors\models\VendorAreaList();
          $new_area->vendor_id = $model->id;
          $new_area->area_id = $area;
          $new_area->save();
        }
                
        return $this->redirect(['admin/index']);
        
      }
    }

    return $this->render('update', [
      'model' => $model,
      'types' => $types,
      'areas' => $areas,
      'user' => $user, 
      'subtypes' => $subtypes,
      'current_user_id' => $current_user_id,
    ]);           
  }    
  
  public function actionAdd() {
    
    //Yii::$app->cache->flush();
    
    $current_user_id = \Yii::$app->user->identity->ID;
        
    $model = new \humhub\modules\stepstone_vendors\models\Vendors();
    $this->mTypes = new \humhub\modules\stepstone_vendors\models\VendorTypes();
    $types = ArrayHelper::map($this->mTypes::find()->all(),'type_id','type_name');
    $areas = $this->mAreas::find()->all();          
    $this->mAreaList = new \humhub\modules\stepstone_vendors\models\VendorAreaList();    

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
      
      $this->mAreaList::deleteAll(['vendor_id' => $model->id]);
      $selected_areas = explode(',', $model->areas);      
      foreach($selected_areas as $area) {
        $new_area = new \humhub\modules\stepstone_vendors\models\VendorAreaList();
        $new_area->vendor_id = $model->id;
        $new_area->area_id = $area;
        $new_area->save();
      }
      
      return $this->redirect(['admin/index']);
    }

    return $this->render('add', [
      'model' => $model, 
      'types' => $types,
      'areas' => $areas,
      'user' => array(), 
      'current_user_id' => $current_user_id,
    ]);
        
  }
    
  public function actionDelete($id) {

    $model = $this->findVenderModel($id);
    $model->delete();
    
    $this->mAreaList = new \humhub\modules\stepstone_vendors\models\VendorAreaList();    
    $this->mAreaList::deleteAll(['vendor_id' => $id]);    

    return $this->redirect(['admin/index']);

  }
  
  protected function findVenderModel($id){

    $mVendors = new \humhub\modules\stepstone_vendors\models\Vendors();

    if(($model = $mVendors::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }     
  
  public function actionAddsubtype($id, $name) {
    
    $model = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();
    //$subtypes = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
      return $this->redirect(['admin/updatetype', 'id' => $id]);
    }

    return $this->render('add-subtype', ['model' => $model, 'id' => $id, 'name' => $name]);
        
  }
  
  public function actionUpdatesubtype($subtype_id, $id, $name) {
    
    $mSubTypes = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();

    $model = $mSubTypes::find()->where(['subtype_id' => $subtype_id])->one();      
    
    
    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
      return $this->redirect(['admin/updatetype', 'id' => $id]);
    }

    return $this->render('update-subtype', ['model' => $model, 'id' => $id, 'name' => $name]);
        
  }
  
  public function actionDeletesubtype($subtype_id, $id) {

    $model = $this->findVenderSubtypeModel($subtype_id);
    $model->delete();

    return $this->redirect(['admin/updatetype', 'id' => $id]);

  }
  
  protected function findVenderSubtypeModel($subtype_id){

    $mSubtypes = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();

    if(($model = $mSubtypes::findOne($subtype_id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }   
  
  public function actionAjaxSubtypes() {
    
    $req = Yii::$app->request;
    
    $html = "";
    
    $vendor_type = $req->get('vendor_type', 0);    
    
    $connection = Yii::$app->getDb();
            
    $command = $connection->createCommand("select subtype_id, subtype_name from vendor_sub_type where type_id = $vendor_type");
          
    //$sql = $command->sql;
    
    $sub_vendors = $command->queryAll();   
    
    foreach($sub_vendors as $sub_vendor) {
      $html .= '<option value="'.$sub_vendor['subtype_id'].'">'.$sub_vendor['subtype_name'].'</option>' . PHP_EOL;
    }
    
    echo $html;
    
    die();
    
  }
  
  public function actionVendorareas() {
    
    //Yii::$app->cache->flush();
    //return $this->render('vendorareas');
    
    $searchModel = new \humhub\modules\stepstone_vendors\models\AreasSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $dataProvider->sort->defaultOrder = ['area_name' => SORT_ASC];

    return $this->render('vendorareas', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
      
  }
  
  public function actionAddArea() {
    
    $model = new \humhub\modules\stepstone_vendors\models\VendorAreas();

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
      return $this->redirect(['admin/vendorareas']);
    }

    return $this->render('add-area', ['model' => $model]);
    
    
  }
  
  public function actionUpdatearea($id) {
    
    $this->mAreas = new \humhub\modules\stepstone_vendors\models\VendorAreas();

    $model = $this->mAreas::find()->where(['area_id' => $id])->one();      

    if ($model->load(Yii::$app->request->post()) && $model->validate() &&  $model->save()) {
      return $this->redirect(['admin/vendorareas']);
    }

    return $this->render('updatearea', [
      'model' => $model,
    ]);           
    
  }
  
  public function actionDeleteArea($id) {

    $model = $this->findVenderAreaModel($id);
    $model->delete();

    return $this->redirect(['admin/vendorareas']);

  }  
  
  protected function findVenderAreaModel($id){

    $mAreas = new \humhub\modules\stepstone_vendors\models\VendorAreas();

    if(($model = $mAreas::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }   
  
  
}

