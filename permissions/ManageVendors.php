<?php

namespace humhub\modules\stepstone_vendors\permissions;

use Yii;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;
use humhub\libs\BasePermission;
use humhub\modules\admin\components\BaseAdminPermission;

/**
 * ManagePages Permissions
 */
class ManageVendors extends BaseAdminPermission
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

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return Yii::t('StepstoneVendorsModule.base', 'Can manage vendors');
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return Yii::t('StepstoneVendorsModule.base', 'Allows the user to manage vendors.');
    }

}
