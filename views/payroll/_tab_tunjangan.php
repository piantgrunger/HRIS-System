<div class="panel panel-success"   >
<div class="panel-heading"> Data Tunjangan

</div>
  <div class="panel-body">
     <table class="table">
     <thead>
        <tr>

            <th>Tunjangan</th>
            <th>Jumlah</th>

            <th><a id="btn-add2" href="#"><span class="glyphicon glyphicon-plus"></span>  </a></th>
        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid',
        'allModels' => $model->detailPayrollTunjangan,
        'model' => \app\models\DetPayrollTunjangan::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_tunjangan',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ]
    ]);
    ?>
    </table>
   </div>

</div>
