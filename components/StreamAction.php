<?php

/**
 * Created by PhpStorm.
 * User: USER
 * Date: 6/2/2016
 * Time: 11:57 AM
 */

namespace humhub\modules\stepstone_vendors\components;

use humhub\modules\stepstone_vendors\models\VendorsContentContainer;
use Yii;
use humhub\modules\content\components\actions\ContentContainerStream;
use humhub\modules\content\components\ContentContainerController;
use humhub\modules\post\models\Post;

class StreamAction extends ContentContainerController
{

    public function StreamAction()
    {      
        $this->activeQuery->andWhere(['content.object_model' => 'humhub\modules\post\models\Post']);
        //$this->activeQuery->andWhere(['content.object_model' => 'humhub\modules\stepstone_vendors\models\VendorsContentContainer']);
        //$this->activeQuery->andWhere(['content.object_model' => VendorsContentContainer::class()]);

    }
}
