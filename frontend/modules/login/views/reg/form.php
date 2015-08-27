<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'parent_referral_link')->hiddenInput(['value' => Yii::$app->request->get('ref', false)])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>