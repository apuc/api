<?php
    use frontend\assets\AppAsset;
    use frontend\modules\news;
    use frontend\widgets\Alert;
    use kartik\growl\Growl;
    use yii\helpers\Html;

    /* @var $this \yii\web\View */
    /* @var $content string */

    AppAsset::register($this);

    $user = Yii::$app->user->identity;
    if (empty($user->photo)) {
        $user->photo = "img/avatar5.png";
    }

    if (Yii::$app->session->hasFlash('message')) {
        $message = Yii::$app->session->getFlash('message');
        echo Growl::widget([
            'type'          => $message['type'],
            'title'         => 'Уведомление',
            'icon'          => 'fa fa-info',
            'body'          => $message['message'],
            'showSeparator' => true,
            'delay'         => 500,
            'pluginOptions' => [
                'delay'     => 4000, //This delay is how long the message shows for
                'placement' => [
                    'from'  => 'bottom',
                    'align' => 'right',
                ]
            ]
        ]);
    }
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

                                <img src="<?= \yii\helpers\Url::base(true) . "/" . $user->photo; ?>" class="user-image"
                                     alt="User Image"/>
                                <span class="hidden-xs"><?= $user->username; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= \yii\helpers\Url::base(true) . "/" . $user->photo; ?>"
                                         class="img-circle" alt="User Image"/>

                                    <p>
                                        <?= $user->username . " - " . $user->email; ?>
                                    </p>
                                </li>
                                <!-- Menu Body -->

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="/profile" class="btn btn-default btn-flat">Профиль</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/logout" class="btn btn-default btn-flat">Выход</a>
                                    </div>
                                </li>
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
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= \yii\helpers\Url::base(true) . "/" . $user->photo; ?>" class="img-circle"
                             alt="User Image"/>
                    </div>
                    <div class="pull-left info">
                        Баланс
                        <p><a href="#"> <?= $user->money; ?> р.<br>
                                <small id="view-interkassa-modal">Пополнить</small>
                            </a></p>

                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">Социальные сети</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-vk"></i> <span>Вконтакте</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Подписчики в группу',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'SubscriberVK'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Репосты',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'RepostVK'
                                            ]
                                        )
                                    )
                                ?>
                            </li>

                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Лайки',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'LikeVK'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Опросы',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'InterviewVK'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Комментарии',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'CommentVK'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Друзья',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'FriendVK'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-twitter"></i>
                            <span>Twitter</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Ретвиты',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'RetwitTwitter'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Подписчики',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'SubscriberTwitter'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Избранное',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'FavoriteTwitter'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-instagram"></i>
                            <span>Instagram  </span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Лайки',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'LikeInstagram'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Подписчики',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'SubscriberInstagram'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-buysellads"></i> <span>AskFm</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <?=
                                    \yii\helpers\Html::a(
                                        '<i class="fa fa-circle-o"></i> Лайки',
                                        \yii\helpers\Url::to(
                                            [
                                                '/task/order/view-page',
                                                'type' => 'LikeAskFM'
                                            ]
                                        )
                                    )
                                ?>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="sidebar-menu">
                    <li class="header">Автопродвижение</li>
                    <li class="treeview">
                        <a href=<?= Yii::$app->urlManager->createUrl(''); ?>
                           <i class="fa fa-circle-o"> </i>
                            <span>Вконакте</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href=<?= Yii::$app->urlManager->createUrl(''); ?>
                           <i class="fa fa-circle-o"> </i>
                            <span>Twitter</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href=<?= Yii::$app->urlManager->createUrl(''); ?>
                           <i class="fa fa-circle-o"> </i>
                            <span>Instagram</span>
                        </a>
                    </li>
                </ul>

                <ul class="sidebar-menu">
                    <li class="header">Меню</li>
                    <li class="treeview">
                        <a href=<?= Yii::$app->urlManager->createUrl('/task/order/view-all'); ?>
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
                        <a href="/feedback">
                            <i class="fa fa-question"></i>
                            <span>Тех. поддержка</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="/logout">
                            <i class="fa fa-external-link"></i>
                            <span>Выход</span>
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
                <!--                <ol class="breadcrumb">-->
                <!--                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
                <!--                    <li class="active">Dashboard</li>-->
                <!--                </ol>-->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Info boxes -->
                <?= \common\modules\statistics\widgets\StatisticsMenu::widget() ?>
                <!-- /.row -->

                <!-- MAIN -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8">
                        <!--                        --><? //= Breadcrumbs::widget([
                            //                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            //                        ]) ?>

                        <div id="modal-window-interkassa" class="well modal-window-interkassa">
                            <a class="close-modal-interkassa btn btn-default pull-right" href="#">x</a>

                            <div class="content">
                                <?= \frontend\modules\interkassa\widgets\AddFunds::widget() ?>
                            </div>
                        </div>
                        <div class="modal-layout-interkassa"></div>

                        <?= Alert::widget() ?>
                        <?= $content ?>
                    </div>

                    <div class="col-md-4"><?= news\widgets\LastNews::widget() ?></div>
                </div>
            </section>
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
                    */
        ?>

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

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
