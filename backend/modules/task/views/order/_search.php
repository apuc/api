<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\task\models\form\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'service_id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'kind') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'members_count') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'tag_list') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'age_min') ?>

    <?php // echo $form->field($model, 'age_max') ?>

    <?php // echo $form->field($model, 'friends_count') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'city_text') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'minute_1') ?>

    <?php // echo $form->field($model, 'minutes_5') ?>

    <?php // echo $form->field($model, 'hour_1') ?>

    <?php // echo $form->field($model, 'hours_4') ?>

    <?php // echo $form->field($model, 'day_1') ?>

    <?php // echo $form->field($model, 'sum') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
