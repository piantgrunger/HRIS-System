<?php use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Upload Kelengkapan {modelClass}: ', [
    'modelClass' => 'Pegawai',
]) . $model->nip;


$item =
    [

   
[
        'label' => 'Data Ijazah',
        'content' =>
            $this->render('_form_file_ijazah', [
            'model' => $model,
            'form' => $form
        ]),

    ],

    ]

?>

  <?= Tabs::widget([
      'id' =>'tab_ijazah',
        'items' => $item,
        'options' => ['class' => 'nav-pills'], //
    ]);
    ?>
