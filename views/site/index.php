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
                <p class="card-category">PEGAWAI</p>
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['pegawai'], 0); ?></h3>
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
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['masuk'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['masuk'] / ($data['pegawai']!==0)? ($data['pegawai']):1 * 100, 0); ?> %)</h3>
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
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['ijin'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['ijin'] / ($data['pegawai']!==0)? ($data['pegawai']):1 * 100, 0); ?> %)</h3>
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
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['terlambat'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['terlambat'] / ($data['pegawai']!==0)? ($data['pegawai']):1 * 100, 0); ?> %)</h3>
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
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['pulang_cepat'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['pulang_cepat'] / ($data['pegawai']!==0)? ($data['pegawai']):1 * 100, 0); ?> %)</h3>
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
                <h3 class="card-title"><?= Yii::$app->formatter->asDecimal($data['tidak_masuk'], 0); ?> (<?= Yii::$app->formatter->asDecimal($data['tidak_masuk'] / ($data['pegawai']!==0)? ($data['pegawai']):1 * 100, 0); ?> %)</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> <?= date('d M Y') ?>
                </div>
            </div>
        </div>
    </div>
</div>
