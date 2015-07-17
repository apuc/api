<?php
    /**
     * @var $form \yii\widgets\ActiveForm
     */
?>

<? $form = \yii\widgets\ActiveForm::begin(['id' => 'modal-feedback']); ?>
<?= $form->field($model, 'id')->hiddenInput();?>
<div class="row">
    <div class="col-sm-5">
        <?= $form->field($model, 'email')->textInput(['readonly' => true]); ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model, 'name')->textInput(['readonly' => true]); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'text')->textarea(['readonly' => true]); ?>
    </div>
</div>
<?= $form->field($model, 'response')->textarea(['rows' => 6]); ?>

<?= \yii\helpers\Html::submitButton('Отправить'); ?>

<? \yii\widgets\ActiveForm::end() ?>

