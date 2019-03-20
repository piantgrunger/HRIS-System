<?php

use hscstudio\mimin\components\Mimin;
use yii\helpers\Url;

$menuItems = [
    ['label' => 'Satuan Kerja', 'icon' => ' fa fa-building-o', 'url' => ['/satuan-kerja/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Unit Kerja', 'icon' => 'fa fa-building', 'url' => ['/unit-kerja/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Golongan', 'icon' => ' fa fa-bars', 'url' => ['/golongan/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Jabatan', 'icon' => ' fa fa-cogs', 'url' => ['/jabatan-fungsional/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Eselon', 'icon' => ' fa fa-star', 'url' => ['/eselon/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Pegawai', 'icon' => ' fa fa-users', 'url' => ['/pegawai/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Pegawai  PNS', 'icon' => ' fa fa-users', 'url' => ['/pegawai/pns'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Pegawai Non PNS', 'icon' => ' fa fa-users', 'url' => ['/pegawai/non-pns'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Shift', 'icon' => ' fa fa-clock-o', 'url' => ['/shift/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Hari Libur', 'icon' => ' fa fa-calendar', 'url' => ['/hari-libur/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Absen', 'icon' => ' fa fa-clock-o', 'url' => ['/absen/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Hitung Tunjangan', 'icon' => ' fa fa-money', 'url' => ['/hitung-tunjangan/index'], 'visible' => !Yii::$app->user->isGuest],
];

if (!Yii::$app->user->isGuest) {
    if (Yii::$app->user->identity->username !== 'admin') {
        $menuItems = Mimin::filterMenu($menuItems);
    }
}

$menuItems2 = [
    ['label' => 'Route', 'icon' => ' fa fa-gear', 'url' => ['/mimin/route/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Role', 'icon' => 'fa fa-users', 'url' => ['/mimin/role/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'User', 'icon' => ' fa fa-user-o', 'url' => ['/user/index'], 'visible' => !Yii::$app->user->isGuest],
];

if (!Yii::$app->user->isGuest) {
    if (Yii::$app->user->identity->username !== 'admin') {
        $menuItems2 = Mimin::filterMenu($menuItems2);
    }
}

$menuItems2 = [
    ['label' => 'Route', 'icon' => ' fa fa-gear', 'url' => ['/mimin/route/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Role', 'icon' => 'fa fa-users', 'url' => ['/mimin/role/index'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'User', 'icon' => ' fa fa-user-o', 'url' => ['/user/index'], 'visible' => !Yii::$app->user->isGuest],
];

if (!Yii::$app->user->isGuest) {
    if (Yii::$app->user->identity->username !== 'admin') {
        $menuItems2 = Mimin::filterMenu($menuItems2);
    }
}
?>
<div class="sidebar" data-color="purple" data-background-color="red"data-image="<?= Url::to(['/Image/logo.png']); ?>">



    <div class="logo"> <a  class="simple-text logo-normal" href="<?= Url::to(['/']); ?>">  <img src="<?= Url::to(['/Image/logo.png']); ?>" width="20%">    HRIS System </a></div>


    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item">

                <a class="nav-link" href="<?= Url::to(['/']); ?>"  aria-expanded="false">
                    <i class="fa fa-home"></i>
                    <p>Home</p>
                </a>
            </li>
            <?php if ((Mimin::checkRoute('site/index-user'))) {
                ?>
                <li class="nav-item">

                    <a class="nav-link" href="<?= Url::to(['/site/index-user']); ?>"  aria-expanded="false">
                        <i class="fa fa-user-circle-o"></i>
                        <p>Biodata</p>
                    </a>
                </li>
            <?php }
            ?>

            <li class="nav-item">

                <a class="nav-link" href="#menu" data-toggle="collapse" aria-expanded="false">
                    <i class="fa fa-cubes"></i>
                    <p>Menu</p>
                </a>
                <div class="collapse" id="menu" style="">
                    <ul class="nav">
                        <?php
                        foreach ($menuItems as $menu) {
                            echo '  <li class="nav-item" routerlinkactive="active"><a class="nav-link" href="' . Url::to($menu['url']) . '"><span class="sidebar-mini"><i class="' . $menu['icon'] . '"></i></span><span class="sidebar-normal">' . $menu['label'] . '</span></a></li>';
                        }
                        ?>
                    </ul></div>
            </li>


            <?php if (count($menuItems2) > 0) {
                ?>
                <li class="nav-item">

                    <a class="nav-link" href="#menu1" data-toggle="collapse" aria-expanded="false">
                        <i class="fa fa-users"></i>
                        <p>Manajemen User</p>
                    </a>
                    <div class="collapse" id="menu1" style="">
                        <ul class="nav">
                            <?php
                            foreach ($menuItems2 as $menu) {
                                echo '  <li class="nav-item" routerlinkactive="active"><a class="nav-link" href="' . Url::to($menu['url']) . '"><span class="sidebar-mini"><i class="' . $menu['icon'] . '"></i></span><span class="sidebar-normal">' . $menu['label'] . '</span></a></li>';
                            }
                            ?>
                        </ul></div>
                </li>
            <?php }
            ?>



    </div>
</div>