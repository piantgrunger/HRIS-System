<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\settings\Menus */

$this->title = Yii::t('app', 'Update Menus: {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php $form = ActiveForm::begin(['id' => 'menu-custom-form', 'method' => 'post']); ?>
    <div class="modal-body">
        <div class="box-body">
        <input type="hidden" name="type" value="custom">
        <?= $form->field($model, 'url')->textInput(['placeholder' => 'http://'])->label('URL',['class'=>'required']); ?>
        <?= $form->field($model, 'name')->textInput(['placeholder' => ''])->label('Label',['class'=>'required']); ?>
        <?= $form->field($model, 'icon', ['inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><i class="fa fa-info-circle"></i></span></div>'])->textInput(['autofocus' => false,'placeholder' => 'Select your icon', 'class'=>'form-control icp icp-auto', 'value'=>'fa-archive' ])->label('Icon',['class'=>'required']); ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary pull-right mr10']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
<script src="/yii-application/backend/web/assets/fd652467/jquery.js"></script>
<script src="<?=$jsasset ?>"></script>
