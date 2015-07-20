<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\service\models\form\ServiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'model_name') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'minimum_all_likes') ?>

    <?= $form->field($model, 'minimum_tasks') ?>

    <?php // echo $form->field($model, 'minimum_likes_per_task') ?>

    <?php // echo $form->field($model, 'price_per_like') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
