<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактирование профиля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body">
    <?php
    $form = ActiveForm::begin([
        'id' => 'edit-form',
        'options' => ['class' => 'form-horizontal'],
    ]) ?>
    <?= $form->field($model, 'username')->label('Имя') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

    <div class="form-group">
        <div class="col-lg-11">
            <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>
