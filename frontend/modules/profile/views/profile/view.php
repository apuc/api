<?php
    /**
     * @var $model \common\models\db\User
     */
    $this->title = 'Профиль ' . $model->username;
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Ваш профиль</h3>

        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                    class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i
                    class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <b>Ваше имя:</b> <br />
        <?= $model->username; ?>
    </div>
    <!-- /.box-body -->
    <div class="box-body">
        <b>Email:</b> <br />
        <?= $model->email; ?>
    </div>
    <div class="box-body">
        <b>Ваша реферальная ссылка:</b> <br />
        <?= Yii::$app->urlManager->createAbsoluteUrl(['login/reg', 'ref' => $model->my_referral_link]); ?>
    </div>
    <div class="box-body">
        <b>Рефералов:</b> <br />
        <?= \common\models\db\User::find()->where(['parent_referral_link' => Yii::$app->user->identity->my_referral_link])->count(); ?>
    </div>
    <div class="box-body">
        <b>Рефералы потратили:</b> <br />
        <?php
            $sum = \common\models\db\ReferralMoney::find()->where(['user_id' => Yii::$app->user->getId()])->sum('payment_sum');
            echo $sum ? $sum : 0;
        ?>
    </div>
    <div class="box-body">
        <b>Вы заработали:</b> <br />
        <?php
            $sum = \common\models\db\ReferralMoney::find()->where(['user_id' => Yii::$app->user->getId()])->sum('referral_percent');
            echo $sum ? $sum : 0;
        ?>
    </div>
    <!-- /.box-body -->
    <div class="box-body">
        <?php
            if (empty($model->photo)) {
                echo \yii\helpers\Html::a('Загрузить фото', ['/addphoto']);
            } else {
                echo \yii\helpers\Html::img($model->photo, ['width' => '300px']);
                echo "<br>" . \yii\helpers\Html::a('Обновить фото', ['/addphoto']);
            }
        ?>
    </div>
    <!-- /.box-body -->
</div>
<button onclick="document.location.href='/profile/edit'" class="btn btn-block btn-primary btn-sm">Редактировать</button>
