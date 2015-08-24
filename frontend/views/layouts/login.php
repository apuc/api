<?php
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use frontend\assets\AppAsset;
    use frontend\widgets\Alert;

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
<body class="login-page">
<?php $this->beginBody() ?>

<div class="login-box">
    <div class="login-logo">
        <a href="/">AUTOSMM</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <?= Alert::widget() ?>
        <?= $content ?>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
