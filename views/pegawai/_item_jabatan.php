<?php
use  kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use app\models\JabatanFungsional;
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;

$dataGolongan = ArrayHelper::map(
    JabatanFungsional::find()
                        ->select(['id' => 'id_jabatan_fungsional', 'nama' => 'nama_jabatan_fungsional'])
                        ->asArray()
                        ->all(),
    'id',
    'nama'
);

?>
<td>
            <?= $form->field($model, "[$key]tanggal1")->textInput(['class' => 'form-control datepicker', 'value' => yii::$app->formatter->asDate($model->tanggal1, 'd-M-yyyy')])

                ->label(false); ?>

</td>
<td>
     <?= $form->field($model, "[$key]id_jabatan")->widget(Select2::className(), ['data' => $dataGolongan,
             'options' => ['prompt' => 'Pilih Jabatan...',

             ], ])->label(false); ?>

</td>
<td>
   <?php if (!$model->isNewRecord) {
                 ?>
<?= Html::a('File SK Jabatan', ['/media/kelengkapan/'.$model->file]) ?>
            <?php
             } ?>

        <?= $form->field($model, "[$key]file_pendukung")->fileInput()

             ->label('Upload', ['class'=>'btn btn-primary'])
                                ->fileInput(['class'=>'sr-only']) ?>


</td>


    <td>

    <a data-action="delete" id='delete2'><span class="glyphicon glyphicon-trash">
    <?= $form->field($model, "[$key]jenis")->hiddenInput(['maxlength' => true,'value' => 'sk_jabatan'])->label(false);  ?>
<?= $form->field($model, "[$key]index")->hiddenInput(['maxlength' => true,'value' => $key])->label(false);  ?>
<?= $form->field($model, "[$key]id_d_pangkat")->hiddenInput(['maxlength' => true])->label(false);  ?>

</td>

<?= $this->registerJsFile('@web/creative/assets/js/plugins/moment.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/bootstrap-datetimepicker.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/jasny-bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php

$script = "

$('body').on('focus',\".datepicker\", function(){
    $(this).datetimepicker({
        format: 'DD-MM-YYYY'
        }
    )
})

    ";

    $this->registerJs($script);


?>