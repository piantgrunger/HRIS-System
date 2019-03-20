<?php
use  kartik\select2\Select2;
use kartik\datecontrol\DateControl;

$data = [
     6 => 'Minggu',
     0 => 'Senin',
     1 => 'Selasa',
    2 => 'Rabu',
    3 => 'Kamis',
     4 => 'Jumat',
     5 => 'Sabtu',
];

?>
<td>
<?= $form->field($model, "[$key]hari")->widget(Select2::classname(), [
    'data' => $data,
    'options' => [
        'placeholder' => 'Pilih Hari ...',
    ],
    'pluginOptions' => [
        'allowClear' => true,
    ],
])->label(false); ?>

</td>
<td>
<?= $form->field($model, "[$key]jam_masuk")->textInput(['class' => 'form-control timepicker'])->label(false);
 ?>

</td>
<td>
<?= $form->field($model, "[$key]jam_pulang")->textInput(['class' => 'form-control timepicker'])->label(false); ?>

</td>

    <td>

    <a data-action="delete" id='delete3'><span class="glyphicon glyphicon-trash">
</td>
