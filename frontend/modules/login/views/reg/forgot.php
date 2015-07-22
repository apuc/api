<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Восстонавление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
Для восстановления пароля укажите свой Email.
<?= Html::beginForm(['forgot', 'id' => $id], 'post') ?>
<?= Html::input('text', 'email') ?>
<?= Html::submitButton('Отправить', ['class' => 'submit']) ?>
<?= Html::endForm() ?>