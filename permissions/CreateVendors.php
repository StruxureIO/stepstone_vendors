<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\stepstone_vendors\permissions;

use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;
use Yii;
use humhub\libs\BasePermission;
use humhub\modules\admin\components\BaseAdminPermission;

/**
 * CreateEntry Permission
 */
class CreateVendors extends \humhub\libs\BasePermission
{
    /**
     * @inheritdoc
     */
    protected $moduleId = 'stepstone_vendors';
    
    /**
     * @inheritdoc
     */
    public $defaultAllowedGroups = [
        Space::USERGROUP_OWNER,
        Space::USERGROUP_ADMIN,
        Space::USERGROUP_MODERATOR,
        Space::USERGROUP_MEMBER,
        User::USERGROUP_SELF
    ];

    /**
     * @inheritdoc
     */
    protected $fixedGroups = [
        Space::USERGROUP_USER,
        User::USERGROUP_FRIEND,
        User::USERGROUP_GUEST,
        User::USERGROUP_USER,
        User::USERGROUP_FRIEND,
        Space::USERGROUP_GUEST,
    ];
    
    public function getTitle()
    {
        return Yii::t('StepstoneVendorsModule.permissions', 'Create vendor');
    }

    public function getDescription()
    {
        return Yii::t('StepstoneVendorsModule.permissions', 'Allows the user to create new vendor entries');
    }

}
