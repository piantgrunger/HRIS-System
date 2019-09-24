<div class="panel panel-danger"   >
<div class="panel-heading"> Data Potongan

</div>
  <div class="panel-body">
     <table class="table">
     <thead>
        <tr>

            <th>Potongan</th>
            <th>Jumlah</th>

            <th><a id="btn-addx" href="#"><span class="glyphicon glyphicon-plus"></span>  </a></th>
        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-gridx',
        'allModels' => $model->detailPayrollPotongan,
        'model' => \app\models\DetPayrollPotongan::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_potongan',
        'clientOptions' => [
            'btnAddSelector' => '#btn-addx',
        ]
    ]);
    ?>
    </table>
   </div>

</div>
