    <?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\helpers\Html;

?>


<?php
NavBar::begin([
      //'brandLabel' => '<img src="'.Url::to(['/Image/logo.png']).'" class="pull-left" width="30%"/><p class="title-nav"> <b>  HRIS <br>  System </b> </p>',
       // 'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar  navbar-transparent  fixed-top ',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid',
        ],
    ]);
?>




<div class="navbar-header">

						<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
                        
                        <a class="navbar-brand" href="#"><?= (\yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->id)) == 'Site') ? 'HRIS System' : \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->id)); ?></a>


					</div>

              
                       <ul class="navbar-nav navbar-right nav">

                       
                       
                       <li class="nav-item dropdown">
                <a  href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"  aria-expanded="true">
                <i class="fa fa-user-o"></i> <?=' '.Yii::$app->user->identity->username; ?>

                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="<?=Url::to(['/site/ubah-password/']); ?>">Ubah Password</a>
                  <div class="dropdown-divider"></div>
                  <?= Html::a('Logout', Url::to(['/site/logout']), ['data-method' => 'POST', 'class' => 'dropdown-item']); ?>
                </div>
              </li>
                       </ul>
<?php


    NavBar::end();
    ?>
