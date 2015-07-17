<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username') ?>

<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password_hash') ?>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>