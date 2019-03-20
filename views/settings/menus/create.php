<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\settings\Menus */

$this->title = Yii::t('app', 'Create Menus');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
