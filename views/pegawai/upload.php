<?php use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;
use yii\helpers\Html;








$this->title = Yii::t('app', 'Upload Kelengkapan {modelClass}: ', [
    'modelClass' => 'Pegawai',
]) . $model->nip;


$form = ActiveForm::begin(['id' => 'form-modules', 'class' => 'form-horizontal', 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]);
$item =
    [

    [
        'label' => 'Data File SK Pangkat dan Jabatan',
        'options' => ['id' => 'tab1'],
        'content' =>
            $this->render('upload_sk', [
            'model' => $model,
           
            'form' => $form,
          
        ]),
     
    ],

    [
        'label' => 'Data File Ijazah dan Tugas Belajar',
        'options' => ['id' => 'tab2'],
        'content' =>
            $this->render('upload_ijasah', [
 
            'model' => $model,
            'form' => $form
        ]),


    ],

    ]

?>
      <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">people</i>
                </div>
                <h4 class="card-title"><?=$this->title?></h4>
            </div>
            <div class="card-body ">

  <?= Tabs::widget([
      'id' =>'tab_upload',
        'items' => $item,
        'options' => ['class' => 'nav-pills'], //
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    </div>

</div>
</div>



</div>


   <?php ActiveForm::end(); ?>
