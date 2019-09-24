<?php
use kartik\select2\Select2;
use app\models\Potongan;
use yii\helpers\ArrayHelper;

$data = ArrayHelper::map(Potongan::find()->select(['id_potongan','nama_potongan'=>"concat(kode_potongan,' - ',nama_potongan)"])
->asArray()->all(), 'id_potongan', 'nama_potongan');

?>
<td>
<?= $form->field($model, "[$key]id_potongan")->widget(Select2::classname(), [
    'data' => $data,
    'options' => [
        'placeholder' => 'Pilih Potongan ...',
    ],
    'pluginOptions' => [
        'allowClear' => true,
    ],
])->label(false); ?>

</td>
<td>
<?= $form->field($model, "[$key]jumlah")->textInput()->label(false);
?>

</td>


    <td>

    <a data-action="delete" id='delete3'><span class="glyphicon glyphicon-trash">
</td>
