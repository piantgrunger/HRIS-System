<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
            'main-login',
        ['content' => $content]
    );
} else {
    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    //$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');?>
    <?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language; ?>">
        <head>
            <meta charset="<?= Yii::$app->charset; ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?= Html::csrfMetaTags(); ?>
            <title><?= Html::encode($this->title); ?></title>
            <link rel="icon" type="image/png" href="<?= Url::to('@web/Image/logo.png'); ?>">
            <?php $this->head(); ?>
        </head>
        <body >
            <?php $this->beginBody(); ?>
            <div class="wrapper ">
                <?=
                $this->render(
                        'left.php'
                ); ?>
                <?=
                $this->render(
                        'content.php',
                    ['content' => $content]
                ); ?>
            </div>
            <?php if (is_null(yii::$app->user->identity->id_pegawai)) {
                    ?>
             <div class="fixed-plugin">
                <div class="dropdown show-dropdown">
                    <a href="#" data-toggle="dropdown">
                        <i class="fa fa-cog fa-2x"> </i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header-title"> Sidebar Filters</li>
                        <li class="adjustments-line">
                            <a href="javascript:void(0)" class="switch-trigger active-color">
                                <div class="badge-colors ml-auto mr-auto">
                                    <span class="badge filter badge-purple" data-color="purple"></span>
                                    <span class="badge filter badge-azure" data-color="azure"></span>
                                    <span class="badge filter badge-green" data-color="green"></span>
                                    <span class="badge filter badge-warning" data-color="orange"></span>
                                    <span class="badge filter badge-danger" data-color="danger"></span>
                                    <span class="badge filter badge-rose active" data-color="rose"></span>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="header-title">Sidebar Background</li>
                        <li class="adjustments-line">
                            <a href="javascript:void(0)" class="switch-trigger background-color">
                                <div class="ml-auto mr-auto">
                                    <span class="badge filter badge-black active" data-background-color="black"></span>
                                    <span class="badge filter badge-white" data-background-color="white"></span>
                                    <span class="badge filter badge-red" data-background-color="red"></span>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="adjustments-line">
                            <a href="javascript:void(0)" class="switch-trigger">
                                <p>Sidebar Mini</p>
                                <label class="ml-auto">
                                    <div class="togglebutton switch-sidebar-mini">
                                        <label>
                                            <input type="checkbox">
                                            <span class="toggle"></span>
                                        </label>
                                    </div>
                                </label>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="adjustments-line">
                            <a href="javascript:void(0)" class="switch-trigger">
                                <p>Sidebar Images</p>
                                <label class="switch-mini ml-auto">
                                    <div class="togglebutton switch-sidebar-image">
                                        <label>
                                            <input type="checkbox" checked="">
                                            <span class="toggle"></span>
                                        </label>
                                    </div>
                                </label>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="header-title">Images</li>
                        <li class="active">
                            <a class="img-holder switch-trigger" href="javascript:void(0)">
                                <img src="<?= Url::to('@web/creative/assets/img/sidebar-1.jpg'); ?>" alt="">
                            </a>
                        </li>
                        <li>
                            <a class="img-holder switch-trigger" href="javascript:void(0)">
                                <img src="<?= Url::to('@web/creative/assets/img/sidebar-2.jpg'); ?>" alt="">
                            </a>
                        </li>
                        <li>
                            <a class="img-holder switch-trigger" href="javascript:void(0)">
                                <img src="<?= Url::to('@web/creative/assets/img/sidebar-3.jpg'); ?>" alt="">
                            </a>
                        </li>
                        <li>
                            <a class="img-holder switch-trigger" href="javascript:void(0)">
                                <img src="<?= Url::to('@web/creative/assets/img/sidebar-4.jpg'); ?>" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <?php
                }
    $this->endBody(); ?>
        </body>
    </html>
    <?php $this->endPage(); ?>
<?php
} ?>
