<?php
$this->title = Yii::t('app', 'Dashboard');
?>
<div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">person</i>
                </div>
                <p class="card-category">PNS</p>
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['pns'], 0); ?></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> <?= date('d M Y') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <p class="card-category">NON PNS</p>
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['non_pns'], 0); ?> </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> <?= date('d M Y') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">alarm_on</i>
                </div>
                <p class="card-category">ON TIME</p>
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['masuk'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['masuk'] / ($data['pns'] + $data['non_pns']) * 100, 0); ?> %)</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> <?= date('d M Y') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">all_inbox</i>
                </div>
                <p class="card-category">IZIN</p>
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['ijin'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['ijin'] / ($data['pns'] + $data['non_pns']) * 100, 0); ?> %)</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> <?= date('d M Y') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">weekend</i>
                </div>
                <p class="card-category">TERLAMBAT</p>
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['terlambat'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['terlambat'] / ($data['pns'] + $data['non_pns']) * 100, 0); ?> %)</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> <?= date('d M Y') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">card_travel</i>
                </div>
                <p class="card-category">PULANG AWAL</p>
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['pulang_cepat'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['pulang_cepat'] / ($data['pns'] + $data['non_pns']) * 100, 0); ?> %)</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> <?= date('d M Y') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment_turned_in</i>
                </div>
                <p class="card-category">TIDAK ABSEN</p>
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['absen_pulang'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['absen_pulang'] / ($data['pns'] + $data['non_pns']) * 100, 0); ?> %)</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> <?= date('d M Y') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">calendar_today</i>
                </div>
                <p class="card-category">TIDAK MASUK</p>
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['tidak_masuk'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['tidak_masuk'] / ($data['pns'] + $data['non_pns']) * 100, 0); ?> %)</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> <?= date('d M Y') ?>
                </div>
            </div>
        </div>
    </div>
</div>
