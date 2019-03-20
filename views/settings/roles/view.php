<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\settings\Roles */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">keyboard_arrow_left</i> Back', ['settings/roles'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('<i class="material-icons">edit</i>' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?=
                Html::a('<i class="material-icons">close</i>' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card" style="min-height: 700px">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title"><?= Html::encode($this->title) ?> -
                    <small class="description">View</small>
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="nav nav-pills nav-pills-rose flex-column" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link  <?= $tabinfo ?>" data-toggle="tab" href="#link4" role="tablist">
                                    General
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $tabaccess ?>" data-toggle="tab" href="#link5" role="tablist">
                                    Access
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane <?= $tabinfo ?>" id="link4">
                                <?=
                                DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'id',
                                        'name',
                                        'display_name',
                                        'description'
                                    ],
                                ])
                                ?>
                            </div>
                            <div class="tab-pane <?= $tabaccess ?>" id="link5">
                                <div class="table-responsive">
                                    <?php $form = ActiveForm::begin(['id' => 'form-modules', 'method' => 'post', 'action' => ['settings/roles/save_module_role_permissions']]); ?>
                                    <input type="hidden" name="id" value="<?= $model->id ?>">
                                    <table class="table">
                                        <thead>
                                            <tr class="blockHeader">
                                                <th width="30%">
                                                    <input class="alignTop" type="checkbox" id="module_select_all" id="module_select_all" checked="checked">&nbsp; Modules
                                                </th>
                                                <th width="14%">
                                                    <input type="checkbox" id="view_all" checked="checked">&nbsp; View
                                                </th>
                                                <th width="14%">
                                                    <input type="checkbox" id="create_all" checked="checked">&nbsp; Create
                                                </th>
                                                <th width="14%">
                                                    <input type="checkbox" id="edit_all" checked="checked">&nbsp; Edit
                                                </th>
                                                <th width="14%">
                                                    <input class="alignTop" id="delete_all" type="checkbox"  checked="checked">&nbsp; Delete
                                                </th>
                                            </tr>
                                        </thead>
                                        <?php foreach ($modules_access as $key => $value) : ?>
                                            <tr>
                                                <td><input module_id="<?= $value->id ?>" class="module_checkb" type="checkbox" name="module_<?= $value->id ?>" id="module_<?= $value->id ?>" checked="checked">&nbsp; <?= $value->name ?></td>
                                                <td><input module_id="<?= $value->id ?>" class="view_checkb" type="checkbox" name="module_view_<?= $value->id ?>" id="module_view_<?= $value->id ?>" <?php
                                                    if ($value->acc_view == 1) {
                                                        echo 'checked="checked"';
                                                    }
                                                    ?> ></td>
                                                <td><input module_id="<?= $value->id ?>" class="create_checkb" type="checkbox" name="module_create_<?= $value->id ?>" id="module_create_<?= $value->id ?>" <?php
                                                    if ($value->acc_create == 1) {
                                                        echo 'checked="checked"';
                                                    }
                                                    ?> ></td>
                                                <td><input module_id="<?= $value->id ?>" class="edit_checkb" type="checkbox" name="module_edit_<?= $value->id ?>" id="module_edit_<?= $value->id ?>" <?php
                                                    if ($value->acc_edit == 1) {
                                                        echo 'checked="checked"';
                                                    }
                                                    ?> ></td>
                                                <td><input module_id="<?= $value->id ?>" class="delete_checkb" type="checkbox" name="module_delete_<?= $value->id ?>" id="module_delete_<?= $value->id ?>" <?php
                                                    if ($value->acc_delete == 1) {
                                                        echo 'checked="checked"';
                                                    }
                                                    ?> >
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?= Html::submitButton('<i class="material-icons">check</i> Update', ['class' => 'btn btn-fill btn-rose']) ?>
                                        </div>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->registerJsFile('@web/js/roles.js?v=' . date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
