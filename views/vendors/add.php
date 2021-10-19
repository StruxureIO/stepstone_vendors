<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

humhub\modules\stepstone_vendors\assets\Assets::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Vendortypes */

$this->title = 'Add New Vendor';
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => ['admin/add']];
$this->params['breadcrumbs'][] = 'Add';

?>
<div class="tag-update">
  
    <?= $this->render('_form', [
      'model' => $model, 
      'types' => $types,
      'areas' => $areas,
      'user' => $user, 
      'current_user_id' => $current_user_id,
      'subtypes' => $subtypes,
      'cguid' => $cguid,  
      //'submit_url' => $submit_url,
    ]) ?>
  
  <!--see videos admin _videoform.php-->
  
<!--<button type="submit" id="h567146w9" class="btn btn-primary" data-action-click="ui.modal.submit" data-action-click-url="/humhub/index.php?r=tasks%2Ftask%2Fedit&amp;cal=0&amp;cguid=178fdc90-6ef5-4b12-ba86-d66d2a018776" data-ui-loader="">Save</button>-->  

<!--use humhub\modules\content\widgets\WallEntryControlLink;

class EditLink extends WallEntryControlLink

    public function init()
    {
        $this->label = Yii::t('ContentModule.widgets_views_editLink', 'Edit');
        $this->icon = 'fa-pencil';
        $this->options = [
            'data-action-click' => 'calendar.editModal',
            'data-action-target' =>"[data-content-key='".$this->entry->content->id."']",
            'data-action-url' => Url::toEditEntry($this->entry, 1)
        ];

        parent::init();
    }-->

	<!--http://localhost/humhub/index.php?r=stepstone_vendors/vendors/add&cguid=178fdc90-6ef5-4b12-ba86-d66d2a018776&_pjax=#layout-content&_=1629221014258-->
<!--            'data-action-click' => 'calendar.editModal',
            'data-action-target' =>"[data-content-key='".$this->entry->content->id."']",
            'data-action-url' => Url::toEditEntry($this->entry, 1)-->


<!--                    <a href="#" class="selectedOnly filedelete-button" style="display:none"
                       data-action-click="deleteSelection"
                       data-action-submit
                    </a>-->

    

</div>
