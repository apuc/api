<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\modules\login\models\forms\LoginForm */

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->session->hasFlash('feedBackDone')){
    echo "<script>alert('Сообщение отправлено');</script>";
}
?>
<div style="padding: 20px">
<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($model, 'name')->label('ФИО') ?>
<?= $form->field($model, 'email')->label('Email') ?>
<?= $form->field($model, 'text')->label('Сообщение')->textArea(['rows' => '6']); ?>

    <div class="form-group">
        <div class="col-lg-11">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
</div>