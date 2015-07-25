<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $model \backend\modules\login\models\forms\LoginForm */

    $this->title = 'Вход';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
            <div class="form-group">
                <?= Html::a('Восставлнеие пароля', ["/forgot"]) ?> |
                <?= Html::a('Регистрация', ["/registration"]) ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>