<?php

use humhub\modules\stepstone_vendors\Module;
use humhub\modules\stepstone_vendors\Events;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\modules\space\widgets\Menu;
use humhub\widgets\TopMenu;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\content\widgets\WallEntryAddons;
use humhub\modules\content\widgets\WallEntryLinks;
use humhub\modules\search\engine\Search;
use humhub\modules\dashboard\widgets\Sidebar;

return [
	'id' => 'stepstone_vendors',
	'class' => Module::class,
	'namespace' => 'humhub\modules\stepstone_vendors',
	'events' => [
    //['class' => Menu::class, 'event' => Menu::EVENT_INIT, 'callback' => [Events::class, 'onSpaceMenuInit']],
    ['class' => Menu::class, 'event' => Menu::EVENT_INIT, 'callback' => [Events::class, 'onSpaceMenuInit']],
		['class' => TopMenu::class, 'event' => TopMenu::EVENT_INIT, 'callback' => [Events::class, 'onTopMenuInit'],],
		['class' => AdminMenu::class, 'event' => AdminMenu::EVENT_INIT, 'callback' => [Events::class, 'onAdminMenuInit']],
    ['class' => Search::class, 'event' => Search::EVENT_SEARCH_ATTRIBUTES, 'callback' => [Events::class, 'onSearchAttributes']],
	  ['class' => Search::class, 'event' => Search::EVENT_ON_REBUILD, 'callback' => [Events::class, 'onSearchRebuild']],
    ['class' => Sidebar::class, 'event' => Sidebar::EVENT_INIT, 'callback' => [Events::class, 'addVendorDashboard']],      
],
];
