<?php use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Upload Kelengkapan {modelClass}: ', [
    'modelClass' => 'Pegawai',
]) . $model->nip;


$item =
    [

    [
        'label' => 'Data File SK Pangkat',
        'content' =>
            $this->render('_form_file_pangkat', [
            'model' => $model,
            'form' => $form
        ]),

    ],
    [
        'label' => 'Data File SK Jabatan',
        'content' =>
            $this->render('_form_file_jabatan', [
            'model' => $model,
            'form' => $form
        ]),

    ],
        [
        'label' => 'Data File Surat Perintah Melaksanakan Tugas',
        'content' =>
            $this->render('_form_file_spmt', [
            'model' => $model,
            'form' => $form
        ]),

    ],
[
        'label' => 'Data File SK Kenaikan Gaji',
        'content' =>
            $this->render('_form_file_gaji', [
            'model' => $model,
            'form' => $form
        ]),

    ],

    ]

?>

  <?= Tabs::widget([
        'id' =>'tab_sk',      
        'items' => $item,
        'options' => ['class' => 'nav-pills'], //
    ]);
    ?>
