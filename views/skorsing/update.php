<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Skorsing */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Skorsing',
]) . $model->id_skorsing;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Skorsing'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_skorsing, 'url' => ['view', 'id' => $model->id_skorsing]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="skorsing-update">


    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">gavel</i>
                    </div>
                    <h4 class="card-title"><?= Html::encode($this->title); ?> </h4>
                </div>
                <div class="card-body ">
                    <?=
                        $this->render('_form', [
                            'model' => $model,
                        ])
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
</div>