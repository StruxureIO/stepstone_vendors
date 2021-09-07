<?php

namespace humhub\modules\stepstone_vendors\widgets;
use humhub\modules\content\widgets\stream\WallStreamModuleEntryWidget;

class WallEntry extends WallStreamModuleEntryWidget
{
  
    public $jsWidget = '';

    public $vendors;
  
    protected function renderContent()
    {
        return $this->render('wallEntry', ['vendors' => $this->model]);
    }

    protected function getIcon()
    {
        return 'address-book';
    }

    protected function getTitle()
    {
        return $this->model->vendor_name;
    }
}

?>