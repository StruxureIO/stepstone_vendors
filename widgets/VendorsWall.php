<?php

namespace humhub\modules\stepstone_vendors\widgets;

class VendorsWall extends \yii\base\Widget
{

    public $vendors;

    public function run()
    {
        return $this->render('vendorswall', ['vendors' => $this->vendors]);
    }

}

?>