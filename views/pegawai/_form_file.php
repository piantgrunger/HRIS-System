<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\UnitKerja;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
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



`   <div class="row">
        <label class="col-md-3 col-form-label">SK CPNS</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                    <img src="<?= Url::to(['/media/kelengkapan/' . $model->file_sk_cpns]) ?>" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div>
                    <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Input Scan SK CPNS</span>
                        <span class="fileinput-exists">Ubah</span>
                        <input type="file" name="Pegawai[file_sk_cpns]" />
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                </div>
            </div>
        </div>
        </div>

`   <div class="row">
        <label class="col-md-3 col-form-label">SK PNS</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                    <img src="<?= Url::to(['/media/kelengkapan/' . $model->file_sk_pns]) ?>" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div>
                    <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Input Scan SK PNS</span>
                        <span class="fileinput-exists">Ubah</span>
                        <input type="file" name="Pegawai[file_sk_pns]" />
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                </div>
            </div>
        </div>
        </div>

`   <div class="row">
        <label class="col-md-3 col-form-label">KARTU PEGAWAI</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                    <img src="<?= Url::to(['/media/kelengkapan/' . $model->file_kartu_pegawai]) ?>" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div>
                    <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Input Scan Kartu Pegawai</span>
                        <span class="fileinput-exists">Ubah</span>
                        <input type="file" name="Pegawai[file_kartu_pegawai]" />
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                </div>
            </div>
        </div>
        </div>

<?= $form->field($model, 'nip')->hiddenInput(['maxlength' => true])->label(false);  ?>

<?= $this->registerJsFile('@web/creative/assets/js/plugins/moment.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/bootstrap-datetimepicker.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/jasny-bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/js/pegawai.js?v=' . date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>