<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\stepstone_vendors\widgets;

use humhub\modules\content\models\Content;
use humhub\modules\content\permissions\CreatePublicContent;
use humhub\modules\content\widgets\WallCreateContentForm;
use humhub\modules\file\handler\FileHandlerCollection;
use humhub\modules\post\permissions\CreatePost;
use humhub\modules\space\models\Space;

/**
 * This widget is used include the post form.
 * It normally should be placed above a steam.
 *
 * @since 0.5
 */
class VendorCommentsForm extends WallCreateContentForm
{

    /**
     * @inheritdoc
     */
    public $submitUrl = '/stepstone_vendors/vendors/vendor-comments';


    /**
     * @inheritdoc
     */
    public $vendorId;

    /**
     * @inheritdoc
     */
    public function renderForm()
    {
        return $this->render('vendorCommentsForm', []);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {

        if (!$this->contentContainer->permissionManager->can(new CreatePost())) {
            return;
        }

        if ($this->contentContainer->visibility !== Space::VISIBILITY_NONE && $this->contentContainer->can(CreatePublicContent::class)) {
            $defaultVisibility = $this->contentContainer->getDefaultContentVisibility();
            $canSwitchVisibility = true;
        } else {
            $defaultVisibility = Content::VISIBILITY_PRIVATE;
            $canSwitchVisibility = false;
        }

        $fileHandlerImport = FileHandlerCollection::getByType(FileHandlerCollection::TYPE_IMPORT);
        $fileHandlerCreate = FileHandlerCollection::getByType(FileHandlerCollection::TYPE_CREATE);

        return $this->render('@humhub/modules/content/widgets/views/wallCreateContentForm', [
            'form' => $this->renderForm(),
            'contentContainer' => $this->contentContainer,
            'submitUrl' => $this->contentContainer->createUrl($this->submitUrl, ['vendor_id' => $this->vendorId]),
            'submitButtonText' => $this->submitButtonText,
            'defaultVisibility' => $defaultVisibility,
            'canSwitchVisibility' => $canSwitchVisibility,
            'fileHandlers' => array_merge($fileHandlerCreate, $fileHandlerImport),
        ]);
    }

}
