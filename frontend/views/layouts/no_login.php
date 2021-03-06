<?php
    use frontend\assets\AppAsset;
    use frontend\widgets\Alert;
    use yii\helpers\Html;
    use yii\widgets\Breadcrumbs;

    /* @var $this \yii\web\View */
    /* @var $content string */

    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="interkassa-verification" content="20a6e6203abeee743ba065eee429c803"/>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php $this->beginBody() ?>
<div class="skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">

            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>SMM</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">AUTO<b>SMM</b></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs">Вход / Регистрация</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li><?= Html::a('Вход', ['/loginto']) ?></li>
                                <li><?= Html::a('Регистрация', ['/registration']) ?></li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- sidebar menu: : style can be found in sidebar.less -->


                <!-- sidebar menu: -->
                <ul class="sidebar-menu">
                    <li class="header">Социальные сети</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-vk"></i> <span>Вконтакте</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i> Подписчики в группу</a></li>
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i> Репосты</a></li>
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i> Лайки</a></li>
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i> Опросы</a></li>
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i> Комментарии</a></li>
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i> Друзья</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-twitter"></i>
                            <span>Twitter</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i> Ретвиты</a></li>
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i> Подписчики</a></li>
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i> Избранное</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-instagram"></i>
                            <span>Instagram</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i>Лайки</a></li>
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i>Подписчики</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-buysellads"></i> <span>AskFm</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#" class="warning"><i class="fa fa-circle-o"></i> Лайки</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="sidebar-menu">
                    <li class="header">Меню</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>История заказов</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-newspaper-o"></i>
                            <span>Полезные статьи</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-question"></i>
                            <span>Тех. поддержка</span>
                        </a>
                    </li>
                </ul>
                <!-- sidebar menu END:-->

                <ul class="sidebar-menu">
                    <li class="header">Меню</li>
                    <li class="treeview">
                        <a href="/loginto">
                            <i class="fa fa-check"></i>
                            <span>Вход</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="/news/news/all-news">
                            <i class="fa fa-newspaper-o"></i>
                            <span>Полезные статьи</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="/feedback">
                            <i class="fa fa-question"></i>
                            <span>Тех. поддержка</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Автоматический сервис накрутки вконтакте и других социальных сетях
                    <small>V 2.0</small>
                </h1>
                <!--        <ol class="breadcrumb">-->
                <!--            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
                <!--            <li class="active">Dashboard</li>-->
                <!--        </ol>-->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Info boxes -->

                <?= \common\modules\statistics\widgets\StatisticsMenu::widget() ?>

                <!-- MAIN -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                        <?= Alert::widget() ?>

                        <div id="modal-window-nologin" class="well modal-window-nologin">
                            <a class="close-modal-nologin btn btn-default pull-right" href="#">x</a>

                            <div class="content">
                                Для использования этой возможности сайта, пожалуйста <a
                                    href="<?= Yii::$app->urlManager->createUrl('login/login/view') ?>">зарегестрируйтесь.</a>
                            </div>
                        </div>

                        <?= $content ?>
                    </div>
                </div>
        </div>
        <?php
            /*            NavBar::begin([
                            'brandLabel' => 'My Company',
                            'brandUrl' => Yii::$app->homeUrl,
                            'options' => [
                                'class' => 'navbar-inverse navbar-fixed-top',
                            ],
                        ]);
                        $menuItems = [
                            ['label' => 'Home', 'url' => ['/site/index']],
                            ['label' => 'About', 'url' => ['/site/about']],
                            ['label' => 'Contact', 'url' => ['/site/contact']],
                        ];
                        if (Yii::$app->user->isGuest) {
                            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                        } else {
                            $menuItems[] = [
                                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                'url' => ['/site/logout'],
                                'linkOptions' => ['data-method' => 'post']
                            ];
                        }
                        echo Nav::widget([
                            'options' => ['class' => 'navbar-nav navbar-right'],
                            'items' => $menuItems,
                        ]);
                        NavBar::end();
                    */ ?>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://autosmm.org">autosmm.org</a>.</strong> Все права
            защищены.
        </footer>


        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <div class="modal-layout-nologin"></div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
