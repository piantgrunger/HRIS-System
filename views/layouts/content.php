<?php
use yii\helpers\Url;
use app\widgets\InboxWidget;

InboxWidget::run();

?>
<div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                        <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                        <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                    </button>
                </div>
                <a class="navbar-brand" href="">
                    <?php if (isset($this->blocks['content-header'])) {
    ?>
                        <?= $this->blocks['content-header']; ?>
                    <?php
} else {
        ?>
                        <?php
                        if ($this->title !== null) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camel2words(
                                \yii\helpers\Inflector::id2camel('HRIS Bagawi')
                            );
                            echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                        } ?>
                    <?php
    } ?></a>

            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <form class="navbar-form">
                    <div class="input-group no-border">
                        <input type="text" value="" class="form-control" placeholder="Search...">
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#pablo">
                            <i class="material-icons">dashboard</i>
                            <p class="d-lg-none d-md-block">
                                Stats
                            </p>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">message</i>
                            <?php if (isset(yii::$app->params["inbox"]) &&(count(yii::$app->params["inbox"])>0)) {
        ?>   <span class="notification"><?= count(yii::$app->params["inbox"])?></span> <?php
    }?>
                            <p class="d-lg-none d-md-block">
                                Pesan
                            </p>
                        </a>
                                              <?php if (isset(yii::$app->params["inbox"])  &&(count(yii::$app->params["inbox"])>0)) {
        ?>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                             <?php     if (isset(yii::$app->params["inbox"])  &&(count(yii::$app->params["inbox"])>0)) {
            foreach (yii::$app->params["inbox"]  as $inbox) {
                ?>
                            <a class="dropdown-item" href=<?=Url::to($inbox['link'])?>><?=$inbox["message"]?></a>
                             <?php
            }
        } ?>
                        </div>
<?php
    }?>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">person</i>
                            <p class="d-lg-none d-md-block">
                                Account
                            </p>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                            <?=
                            \yii\helpers\Html::a(
                                'Log Out',
                                ['/site/logout'],
                                ['data-method' => 'post', 'class' => 'dropdown-item']
                            );
                            ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Content -->
        <div class="content">
            <div class="container-fluid">


                <?= $content; ?>
            </div>

    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <nav class="float-left">
                <ul>
                    <li>
                        <a href="#">
                            HRM System
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright float-right">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>, Phi Soft
            </div>
        </div>
    </footer>
</div>