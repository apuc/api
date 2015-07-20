<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model backend\modules\service\models\db\Service */
    /* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(['id' => 'likeForm']); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'model_name')->textInput([
                'maxlength' => true,
                'readonly'  => true
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'minimum_likes_per_task')->textInput(['class' => 'minimum_likes_per_task form-control']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'minimum_tasks')->textInput(['class' => 'minimum_tasks form-control']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'minimum_all_likes')->textInput([
                'class'    => 'minimum_all_likes form-control',
                'readonly' => true,
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'price_per_like')->textInput(['class' => 'price_per_like form-control',]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'minimum_price_per_task')->textInput([
                'class'    => 'minimum_price_per_task form-control',
                'readonly' => true,
            ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
