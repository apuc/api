<?php
    use yii\helpers\Html;

?>
<div>
    <?php
        $form = \yii\widgets\ActiveForm::begin();
    ?>

    <div class="container-fluid well">
        <h3>Настройка рефералов</h3>

        <div class="row">
            <div
                class="col-lg-6"><?= $form->field($model, 'referral_percent')->input('number', ['min' => 0]); ?>
            </div>
            <div
                class="col-lg-6"><?= $form->field($model, 'referral_pay_num')->input('number', ['min' => 0]); ?>
            </div>
        </div>
    </div>


    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']); ?>
    </div>
    <?php
        \yii\widgets\ActiveForm::end();
    ?>
</div>