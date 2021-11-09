<?php

namespace humhub\modules\stepstone_vendors\controllers;

use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\content\models\Content;
use humhub\modules\content\models\ContentContainer;
use humhub\modules\content\components\ContentContainerController;
use humhub\components\access\ControllerAccess;
use humhub\modules\content\components\ContentContainerControllerAccess;
use humhub\modules\content\widgets\WallCreateContentForm;
use humhub\modules\post\models\Post;
use humhub\modules\post\permissions\CreatePost;
use humhub\modules\space\models\Space;
use humhub\modules\stepstone_vendors\components\OwnContentStreamFilter;
use humhub\modules\stepstone_vendors\models\VendorComments;
use humhub\modules\stream\actions\ContentContainerStream;
use humhub\modules\user\models\Profile;

//use humhub\modules\stepstone_vendors\components\VendorsPostsStreamAction;
use humhub\modules\stepstone_vendors\components\StreamAction;
use humhub\modules\stream\actions\Stream;

use Yii;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use humhub\modules\stepstone_vendors\models\VendorsContentContainer;
use humhub\modules\stepstone_vendors\models\VendorTypes;
use humhub\modules\stepstone_vendors\models\VendorsRatings;
use humhub\modules\stepstone_vendors\models\VendorSubTypes;
use humhub\modules\stepstone_vendors\models\VendorAreas;
use humhub\modules\stepstone_vendors\models\VendorAreaList;
use humhub\modules\stepstone_vendors\widgets\WallEntry;
use yii\helpers\VarDumper;

class VendorsController extends ContentContainerController
{

    public $mTypes;
    public $mVendors;
    public $mUsers;
    public $mRatings;
    public $mSubtypes;
    public $mAreas;
    public $mAreaList;

    public $subLayout = "@stepstone_vendors/views/layouts/default";



    public function actions()
    {
        return [
            'stream' => [
                'class' => ContentContainerStream::class,
                'filterHandlers' => [OwnContentStreamFilter::class],
                'contentContainer' => $this->contentContainer
            ],
        ];
    }



    public function actionIndex()
    {

        $this->subLayout = "@stepstone_vendors/views/layouts/default";

        $connection = Yii::$app->getDb();

        $command = $connection->createCommand("select * from vendor_areas order by area_id limit 0, 6");

        $areas = $command->queryAll();

        return $this->render('index', ['areas' => $areas]);

    }


    public function actionAjaxView($vendor_type_id, $location, $page, $search_text, $vendor_subtype = '')
    {

        //Yii::$app->cache->flush();

        $location_search = false;
        $type_search = false;
        $subtype_search = false;
        $text_search = false;
        $title_text = '';
        $and = false;
        $where = '';

        if (!is_numeric($location))
            $location = '1';

        //$vendor_ids = str_replace('"', '', $vendor_ids);

        $user_id = \Yii::$app->user->identity->ID;

        if ($location != '') {
            $where = " WHERE l.area_id = $location ";
            $and = true;
            $location_search = true;
        }

        if (!empty($vendor_type_id)) {
            if ($and)
                $where .= " and v.vendor_type = $vendor_type_id ";
            else {
                $where .= " WHERE v.vendor_type = $vendor_type_id ";
                $and = true;
            }
            $type_search = true;
        } else if (!empty($vendor_subtype)) {
            if ($and)
                $where .= " and v.subtype = $vendor_subtype ";
            else {
                $where .= " WHERE v.subtype = $vendor_subtype ";
                $and = true;
            }
            $subtype_search = true;
        }

        if ($search_text != '') {
            if ($and)
                $where .= " and (vendor_name like '%$search_text%' or vendor_contact like '%$search_text%') ";
            else
                $where .= " WHERE vendor_name like '%$search_text%' or vendor_contact like '%$search_text%' ";
            $text_search = true;
        }

        $connection = Yii::$app->getDb();

        //$command = $connection->createCommand("select count(id) from vendors as v $where");

        // removed group by to prevent sql error when getting the total records found
        $command = $connection->createCommand("select count(id)
from vendors as v
LEFT JOIN vendor_types as t on t.type_id = v.vendor_type
LEFT JOIN profile as p on p.user_id = v.vendor_recommended_user_id
LEFT JOIN vendor_area_list as l on l.vendor_id = v.id
LEFT JOIN vendor_sub_type as s on s.subtype_id = v.subtype
$where");

        //$sql = $command->sql;

        $count = $command->queryOne();

        $offset = $page * MAX_VENDOR_ITEMS;
        if (isset($count['count(id)']))
            $total_number_pages = ceil($count['count(id)'] / MAX_VENDOR_ITEMS);
        else
            $total_number_pages = 0;

        $command = $connection->createCommand("select v.*, t.type_name, s.subtype_name, l.area_id, p.firstname, p.lastname
from vendors as v
LEFT JOIN vendor_types as t on t.type_id = v.vendor_type
LEFT JOIN profile as p on p.user_id = v.vendor_recommended_user_id
LEFT JOIN vendor_area_list as l on l.vendor_id = v.id
LEFT JOIN vendor_sub_type as s on s.subtype_id = v.subtype
$where group by v.id order by t.type_name, vendor_name limit $offset, " . MAX_VENDOR_ITEMS);

        //$sql = $command->sql;

        if ($count > 0)
            $vendors = $command->queryAll();
        else
            $vendors = null;


        if ($location_search && $location != 1 && $subtype_search)
            $title_text = 'area-subtype-search';
        else if ($location_search && $location != 1 && $type_search)
            $title_text = 'area-type-search';
        else if ($subtype_search)
            $title_text = 'subtype-search';
        else if ($type_search)
            $title_text = 'type-search';
        else if ($location_search && $location != 1)
            $title_text = 'area-search';
        else if ($location_search && $location == 1)
            $title_text = 'all-vendors';

        return $this->renderPartial('_view', [
            'vendors' => $vendors,
            'page' => $page,
            'user_id' => $user_id,
            'total_number_pages' => $total_number_pages,
            'search_text' => $search_text,
            'count' => $count,
            'title_text' => $title_text,
        ]);

    }

    public function actionAdd($cguid)
    {

        //Yii::$app->cache->flush();

        $this->subLayout = "@stepstone_vendors/views/layouts/default";

        $current_user_id = \Yii::$app->user->identity->ID;

        //$model = new \humhub\modules\stepstone_vendors\models\VendorsContentContainer();
        $model = new \humhub\modules\stepstone_vendors\models\VendorsContentContainer($this->contentContainer);
        $this->mTypes = new \humhub\modules\stepstone_vendors\models\VendorTypes();
        $types = ArrayHelper::map($this->mTypes::find()->all(), 'type_id', 'type_name');

        $this->mSubtypes = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();
        $subtypes = ArrayHelper::map($this->mSubtypes::find()->where(['type_id' => 2])->all(), 'subtype_id', 'subtype_name');

        $this->mAreas = new \humhub\modules\stepstone_vendors\models\VendorAreas();
        $this->mAreaList = new \humhub\modules\stepstone_vendors\models\VendorAreaList();

        $areas = $this->mAreas::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $model->content->visibility = Content::VISIBILITY_PUBLIC;

            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = $current_user_id;
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = $current_user_id;

            if ($model->validate() && $model->save()) {

                $this->mAreaList::deleteAll(['vendor_id' => $model->id]);
                $selected_areas = explode(',', $model->areas);
                foreach ($selected_areas as $area) {
                    $new_area = new \humhub\modules\stepstone_vendors\models\VendorAreaList();
                    $new_area->vendor_id = $model->id;
                    $new_area->area_id = $area;
                    $new_area->save();
                }

                //$model->vendorAdded();

                //return $this->redirect(['vendors/index', 'cguid' => $cguid]);
                return $this->redirect(['vendors/rate-vendor?id=' . $model->id, 'cguid' => $cguid]);
            }
        }

        return $this->render('add', [
            'model' => $model,
            'types' => $types,
            'areas' => $areas,
            'user' => array(),
            'current_user_id' => $current_user_id,
            'subtypes' => $subtypes,
            'cguid' => $cguid,
        ]);

    }

    public function actionAjaxRating()
    {

        $total_rating = 0;

        $req = Yii::$app->request;

        $user_rating = $req->get('user_rating', 0);

        $vendor_id = $req->get('vendor_id', 0);

        $user_id = $req->get('user_id', 0);

        $this->mRatings = new \humhub\modules\stepstone_vendors\models\VendorsRatings();
        $model = $this->mRatings::find()->where(['vendor_id' => $vendor_id, 'user_id' => $user_id])->one();

        if ($model) {
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
        //var_dump($rating);

        if ($rating) {
            $total_rating = intval(ceil($rating[0]['vendor_rating']));

            $mVendors = new \humhub\modules\stepstone_vendors\models\VendorsContentContainer();
            $vendors = $mVendors::find()->where(['id' => $vendor_id])->one();

            if ($vendors) {
                $vendors->vendor_rating = $total_rating;
                $vendors->save();
            }

        }

        echo $total_rating;

        die();

    }

    public function actionAjaxSubtypes()
    {

        $req = Yii::$app->request;

        $html = "";

        $vendor_type = $req->get('vendor_type', 0);

        $connection = Yii::$app->getDb();

        $command = $connection->createCommand("select subtype_id, subtype_name from vendor_sub_type where type_id = $vendor_type");

        //$sql = $command->sql;

        $sub_vendors = $command->queryAll();

        foreach ($sub_vendors as $sub_vendor) {
            $html .= '<option value="' . $sub_vendor['subtype_id'] . '">' . $sub_vendor['subtype_name'] . '</option>' . PHP_EOL;
        }

        echo $html;

        die();

    }

    public function actionDetail($id, $cguid)
    {

        $contentContainer = $this->contentContainer;
        $canCreatePosts = $contentContainer->permissionManager->can(new CreatePost());

        $this->subLayout = "@stepstone_vendors/views/layouts/detail-view";

        $mVendors = new \humhub\modules\stepstone_vendors\models\VendorsContentContainer();
        $vendor = $mVendors::find()->where(['id' => $id])->one();

        $mSubtypes = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();
        $subtypes = $mSubtypes::find()->where(['subtype_id' => $vendor['subtype']])->one();

        $mProfile = new \humhub\modules\user\models\Profile();
        $profile = $mProfile::find()->where(['user_id' => $vendor['vendor_recommended_user_id']])->one();

        $connection = Yii::$app->getDb();

//    $command = $connection->createCommand("select vendors_ratings.user_id, user_rating, rating_date, firstname, lastname from vendors_ratings
//LEFT JOIN profile ON vendors_ratings.user_id = profile.user_id
//where vendor_id = $id");
//
//    $ratings = $command->queryAll();

        $connection = Yii::$app->getDb();

        $command = $connection->createCommand("select vendors_ratings.user_id, user_rating, rating_date, firstname, lastname from vendors_ratings
LEFT JOIN profile ON vendors_ratings.user_id = profile.user_id where vendor_id = $id order by rating_date limit 0, 2");

        $latest_ratings = $command->queryAll();


        return $this->render('detail', [
            'vendor' => $vendor,
            'subtypes' => $subtypes,
            'profile' => $profile,
            //'ratings' => $ratings,
            'latest_ratings' => $latest_ratings,
            'cguid' => $cguid,
            'contentContainer' => $contentContainer,
            'canCreatePosts' => $canCreatePosts,

        ]);


    }

    public function actionRateVendor($id, $cguid)
    {

        $this->subLayout = "@stepstone_vendors/views/layouts/detail-view";

        $user_id = \Yii::$app->user->identity->ID;

        $mVendors = new \humhub\modules\stepstone_vendors\models\VendorsContentContainer();
        $vendor = $mVendors::find()->where(['id' => $id])->one();

        $mSubtypes = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();
        $subtypes = $mSubtypes::find()->where(['subtype_id' => $vendor['subtype']])->one();

        $mProfile = new \humhub\modules\user\models\Profile();
        $profile = $mProfile::find()->where(['user_id' => $vendor['vendor_recommended_user_id']])->one();

        $mUserRating = new \humhub\modules\stepstone_vendors\models\VendorsRatings();
        $user_rating = $mUserRating::find()->where(['vendor_id' => $id, 'user_id' => $user_id])->one();

        $connection = Yii::$app->getDb();

        $command = $connection->createCommand("select vendors_ratings.*, firstname, lastname from vendors_ratings
LEFT JOIN profile ON vendors_ratings.user_id = profile.user_id
where vendor_id = $id");

        $ratings = $command->queryAll();

        $connection = Yii::$app->getDb();

        $command = $connection->createCommand("select vendors_ratings.user_id, user_rating, rating_date, firstname, lastname from vendors_ratings
LEFT JOIN profile ON vendors_ratings.user_id = profile.user_id where vendor_id = $id order by rating_date limit 0, 2");

        $latest_ratings = $command->queryAll();


        return $this->render('rate-vendor', [
            'vendor' => $vendor,
            'subtypes' => $subtypes,
            'profile' => $profile,
            'ratings' => $ratings,
            'latest_ratings' => $latest_ratings,
            'user_rating' => $user_rating,
            'cguid' => $cguid,
        ]);


    }

    public function actionAjaxReview($cguid, $vendor_user_review, $user_rating, $vendor_id, $user_id)
    {

        $this->mRatings = new \humhub\modules\stepstone_vendors\models\VendorsRatings();
        $model = $this->mRatings::find()->where(['vendor_id' => $vendor_id, 'user_id' => $user_id])->one();

        if ($model) {
            $model->user_rating = $user_rating;
            $model->review = $vendor_user_review;
            $model->save();
        } else {
            $model = new \humhub\modules\stepstone_vendors\models\VendorsRatings();
            $model->vendor_id = $vendor_id;
            $model->user_id = $user_id;
            $model->user_rating = $user_rating;
            $model->review = $vendor_user_review;
            $model->save();
        }

        $connection = Yii::$app->getDb();

        $command = $connection->createCommand("SELECT AVG(user_rating) as 'vendor_rating' FROM  vendors_ratings WHERE vendor_id = $vendor_id");

        $rating = $command->queryAll();
        //var_dump($rating);

        if ($rating) {
            $total_rating = intval(ceil($rating[0]['vendor_rating']));

            $mVendors = new \humhub\modules\stepstone_vendors\models\VendorsContentContainer();
            $vendors = $mVendors::find()->where(['id' => $vendor_id])->one();

            if ($vendors) {
                $vendors->vendor_rating = $total_rating;
                $vendors->save();
            }

        }


        die();

    }

    public function actionUpdate($id, $cguid)
    {

        //Yii::$app->cache->flush();

        $current_user_id = \Yii::$app->user->identity->ID;

        $this->mVendors = new \humhub\modules\stepstone_vendors\models\Vendors();
        $this->mTypes = new \humhub\modules\stepstone_vendors\models\VendorTypes();
        $this->mUsers = new \humhub\modules\user\models\User();
        $this->mSubtypes = new \humhub\modules\stepstone_vendors\models\VendorSubTypes();
        $this->mAreas = new \humhub\modules\stepstone_vendors\models\VendorAreas();
        $this->mAreaList = new \humhub\modules\stepstone_vendors\models\VendorAreaList();

        $model = $this->mVendors::find()->where(['id' => $id])->one();

        $types = ArrayHelper::map($this->mTypes::find()->all(), 'type_id', 'type_name');

        $areas = $this->mAreas::find()->all();

        $subtypes = ArrayHelper::map($this->mSubtypes::find()->where(['type_id' => $model->vendor_type])->all(), 'subtype_id', 'subtype_name');

        $user = $this->mUsers::find()->where(['id' => $model->vendor_recommended_user_id])->one();

        if ($model->load(Yii::$app->request->post())) {

            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = \Yii::$app->user->identity->ID;

            if ($model->validate() && $model->save()) {

                $this->mAreaList::deleteAll(['vendor_id' => $model->id]);
                $selected_areas = explode(',', $model->areas);
                foreach ($selected_areas as $area) {
                    $new_area = new \humhub\modules\stepstone_vendors\models\VendorAreaList();
                    $new_area->vendor_id = $model->id;
                    $new_area->area_id = $area;
                    $new_area->save();
                }

                //return $this->redirect(['vendors/detail', 'cguid' => $cguid, 'id' => $id]);
                return $this->redirect(['vendors/rate-vendor?id=' . $model->id, 'cguid' => $cguid]);

            }
        }

        return $this->render('update', [
            'model' => $model,
            'types' => $types,
            'areas' => $areas,
            'user' => $user,
            'subtypes' => $subtypes,
            'current_user_id' => $current_user_id,
            'cguid' => $cguid,
        ]);
    }

    /**
     * @return array|mixed
     * @throws \Throwable
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionVendorComments()
    {
        // Check createPost Permission
        if (!$this->contentContainer->getPermissionManager()->can(new CreatePost())) {
            return [];
        }

        $vendorId = Yii::$app->request->get('vendor_id');

        if ($vendorId) {
            $vendorComment = new VendorComments($this->contentContainer);
            $vendorComment->vendor_id = $vendorId;
            $vendorComment->message = Yii::$app->request->post('message');

            return VendorComments::getDb()->transaction(function ($db) use ($vendorComment) {
                return WallCreateContentForm::create($vendorComment, $this->contentContainer);
            });
        } else {
            //TODO Raise an error
        }

    }


}

