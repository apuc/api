<?php
    use kartik\growl\Growl;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $model \backend\modules\login\models\forms\LoginForm */

    $this->title = 'Обратная связь';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Накрутка - <?= $this->title; ?></h3>
    </div>
    <div class="box-body no-padding">
        <div class="row">
            <div class="col-md-12">
                <div role="form">
                    <div class="box-body">
                        <?php
                            $form = ActiveForm::begin([
                                'id' => 'login-form',
                            ]) ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <?= $form->field($model, 'name')->label('ФИО') ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'email')->label('Email') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?= $form->field($model, 'text')->label('Сообщение')->textArea(['rows' => '6']); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>