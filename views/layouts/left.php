<?php
use app\models\settings\Menus;
use hscstudio\mimin\components\Mimin;

$menuItems = [
    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/index'], 'parent' => 0, 'id' => 99],
    [
        'label' => 'Master', 'icon' => 'person', 'url' => ['#'], 'parent' => 0, 'id' => 88,
        'items' => [
            ['label' => 'Satuan Kerja', 'icon' => 'person', 'url' => ['/satuan-kerja/index'], 'parent' => 88, 'id' => 70],
            ['label' => 'Unit Kerja', 'icon' => 'person', 'url' => ['/unit-kerja/index'], 'parent' => 88, 'id' => 69],
            ['label' => 'Jabatan ', 'icon' => 'person', 'url' => ['/jabatan-fungsional/index'], 'parent' => 88, 'id' => 68],

            ['label' => 'Pegawai', 'icon' => 'person', 'url' => ['/pegawai/index'], 'parent' => 88, 'id' => 67],





        ],
    ],

    [
        'label' => 'Pengaturan Absensi', 'icon' => 'date_range', 'url' => ['#'], 'parent' => 0, 'id' => 75,
        'items' => [

            ['label' => 'Shift', 'icon' => 'person', 'url' => ['/shift/index'], 'parent' => 75, 'id' => 73],
            ['label' => 'Hari Libur', 'icon' => 'person', 'url' => ['/hari-libur/index'], 'parent' => 75, 'id' => 72],
            ['label' => 'Ijin', 'icon' => 'person', 'url' => ['/ijin/index'], 'parent' => 75, 'id' => 71],

            ['label' => 'Absensi', 'icon' => 'person', 'url' => ['/absen/index'], 'parent' => 75, 'id' => 74],


            ['label' => 'Jenis Absensi', 'icon' => 'person', 'url' => ['/jenis-absen/index'], 'parent' => 75, 'id' => 72],
        ],
    ],
    [
        'label' => 'Payroll', 'icon' => 'money', 'url' => ['#'], 'parent' => 0, 'id' => 99,
        'items' => [
            ['label' => 'Tunjangan', 'icon' => 'person', 'url' => ['/tunjangan/index'], 'parent' => 99, 'id' => 98],
            ['label' => 'Potongan', 'icon' => 'person', 'url' => ['/potongan/index'], 'parent' => 99, 'id' => 97],
            ['label' => 'Data Payroll', 'icon' => 'person', 'url' => ['/payroll/index'], 'parent' => 99, 'id' => 97],

        ],
    ],

    [
        'label' => 'Laporan Absensi', 'icon' => 'insert_chart_outlined', 'url' => ['#'], 'parent' => 0, 'id' => 78,
        'items' => [
            ['label' => 'Laporan Absensi', 'icon' => 'person', 'url' => ['/absen-bulanan/index'], 'parent' => 78, 'id' => 77],
            ['label' => 'Rekapitulasi Absensi', 'icon' => 'person', 'url' => ['/rekap-absen/index'], 'parent' => 78, 'id' => 76],
        ],
    ],


    [
        'label' => ' User / Group',
        'icon' => 'people',
        'url' => ['#'],
        'parent' => 0, 'id' => 68,
        'items' => [
            [
                'label' => 'App. Route', 'icon' => 'fa fa-circle-o', 'url' => ['/mimin/route/'], 'visible' => !Yii::$app->user->isGuest, 'parent' => 68, 'id' => 67,
            ],
            ['label' => 'Role', 'icon' => 'fa fa-circle-o', 'url' => ['/mimin/role/'], 'visible' => !Yii::$app->user->isGuest, 'parent' => 68, 'id' => 66],

            ['label' => 'User', 'icon' => ' fa fa-circle-o', 'url' => ['/user/index'], 'visible' => !Yii::$app->user->isGuest, 'parent' => 68, 'id' => 65],
        ],
    ],
];

if (!Yii::$app->user->isGuest) {
    if (Yii::$app->user->identity->username !== 'admin') {
        $menuItems = Mimin::filterMenu($menuItems);
    }
}

//use app\models\settings\Menus;
use yii\helpers\Url;

?>

<div class="sidebar" data-color="rose" data-background-color="azure" data-image="<?= Url::to('@web/creative/assets/img/sidebar-1.jpg'); ?>">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="<?= Yii::$app->homeUrl; ?>" class="simple-text logo-mini">
            <img src="<?= Url::to(['/Image/logo.png']); ?>" width="30" height="36" />
        </a>
        <a href="<?= Yii::$app->homeUrl; ?>" class="simple-text logo-normal">
            HRM System
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <?php
                $usr = \app\models\Pegawai::findOne(['nip' => yii::$app->user->identity->username]);
                ?>

                <img src="<?= Url::to($usr['foto'] ? ['/media/' . $usr['foto']] : '@web/media/avatar.png'); ?>" />
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
                    <span>
                        <?= $usr['nama'] ? $usr['nama'] : yii::$app->user->identity->username; ?>
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['site/ubah-password']); ?>">
                                <span class="sidebar-mini"> UP </span>
                                <span class="sidebar-normal"> Ubah Password </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php echo dmstr\widgets\Menu::widget(
                    [
                'options' => ['class' => 'nav'],
                'items' => $menuItems,
            ]

            //Menus::menuItems()
        ); ?>

    </div>
</div>