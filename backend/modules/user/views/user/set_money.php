<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model \backend\modules\user\models\forms\SetMoney */
    /* @var $form yii\widgets\ActiveForm */
    /* @var $user \backend\modules\user\models\User */
?>


<div class="user-form">
    <?php $form = ActiveForm::begin(['method' => 'post']); ?>

    <?= $form->field($model, 'id')->hiddenInput(['value' => $user->id])->label('') ?>
    <p>Пльзователь: <?= $user->username ?> </p>
    <p>Изменить счет пользователя, на это значение</p>
    <?= $form->field($model, 'money')->input('number')->hint('Текущая сумма на счету: ' . $user->money . ' руб.') ?>

    <div class="form-group">
        <?= Html::submitButton('Утвердить сумму', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
