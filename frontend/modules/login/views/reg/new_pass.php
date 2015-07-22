<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $msg; ?></h3>
<div>
    <?= Html::a('Вход на сайт', ['/loginto']) ?>
</div>