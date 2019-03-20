<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\UnitKerja;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use app\helpers\myhelpers;
//use kartik\datecontrol\DateControl;
use app\models\JabatanFungsional;
use app\models\JabatanTambahan;

use app\models\Golongan;
use app\models\Shift;
use app\models\SatuanKerja;
use yii\bootstrap\Tabs;

//use kartik\widgets\FileInput;
/*
$dataUnitKerja = ArrayHelper::map(
                UnitKerja::find()
                        ->select(['id' => 'id_unit_kerja', 'nama' => 'nama_unit_kerja'])
                        ->asArray()
                        ->all(),
    'id',
    'nama'
);
*/
?>
<table class="table">
    <thead>
        <tr>

            <th>TMT</th>
            <th>Jabatan</th>
            <th>File</th>

            <th><a id="btn-add2" href="#"><span class="glyphicon glyphicon-plus"></span></a></th>
        </tr>
    </thead>
    <tbody>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid2',
        'allModels' => $model->detailFileJabatan,
        'model' => \app\models\DetPegawaiFileJabatan::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_jabatan',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ]

    ]);
    ?>
    </tbody>
    </table>



<?= $form->field($model, 'nip')->hiddenInput(['maxlength' => true])->label(false);  ?>
