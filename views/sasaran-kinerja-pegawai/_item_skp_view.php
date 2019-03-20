<?php
use  kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use app\models\Golongan;
use app\helpers\myhelpers;

?>
<td>
<?=!is_numeric($key)?1: $key+1?>
</td>
<td>

<?= !is_numeric($key) ? "": myhelpers::getMonth($key+1) ?>



</td>
<td>
<?= $model->kuantitas ?>

</td>
<td>
<?= $model->satuan_kuantitas ?>

</td>
