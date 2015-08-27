<?php
    /**
     * Форма добавления задания по накрутке лайков
     *
     * @var $model \frontend\modules\task\models\db\Order
     */

    use yii\bootstrap\Alert;
    use yii\helpers\Html;

?>

<div role="form">
    <div class="box-body">
        <!--Причины отклонения модерации-->
        <div class="col-lg-12">
            <?php
                $comments = $model->rejectedComment;
            ?>
            <?php foreach ($comments as $comment): ?>
                <div class="alert-danger alert fade in">
                        <?= $comment->text; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <!--end Причины отклонения модерации-->
        <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'task-form', 'method' => 'post']); ?>
        <?= $form->field($model, 'kind', ['template' => ''])->hiddenInput(); ?>
        <?= $form->field($model, 'service_id', ['template' => ''])->hiddenInput(); ?>

        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'title')->textInput(); ?>
            </div>
        </div>
		<div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'url')->textInput(); ?>
            </div>
			<div class="col-lg-2">
                <?= $form->field($model, 'members_count')->textInput([
                    'class' => 'members_count form-control',
                ]); ?>
            </div>
            <div class="col-lg-2">
                <label class="control-label">За ед, р</label>
                <?= Html::textInput('price_per_one_task', $model->service->price_per_one_task, [
                    'class'    => 'price_per_one_task form-control',
                    'readonly' => true
                ]); ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($model, 'sum')->textInput([
                    'readonly' => true,
                    'class'    => 'sum form-control',
                ]); ?>
            </div>
        </div>
        <div class="row">

        </div>
        <div class="row">
            <div class="col-lg-12 title" >
				Дополнительные условия:
            </div>
        </div>
        <? if ($model->service->network == \common\models\db\Service::VK): ?>
		<div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'sex')->dropDownList([
                    ''  => 'Не выбрано',
                    '1' => 'Женский',
                    '2' => 'Мужской',
                ]); ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'friends_count')->input('number', ['min' => 0]); ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'age_min')->input('number', ['min' => 0]); ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'age_max')->input('number', ['min' => 0]); ?>
            </div>
        </div>
        <div class="row">

        </div>

        <? endif; ?>
		<? if ($model->service->network != \common\models\db\Service::VK): ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'min_followers')->input('number', ['min' => 0]); ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'min_media')->input('number', ['min' => 0]); ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'has_avatar')->dropDownList([
                        '0' => 'Нет',
                        '1' => 'Да',
                    ]); ?>
                </div>
            </div>
        <? endif; ?>
        <? //= $form->field($model, 'city')->textInput(); ?>
		<div class="row">
            <div class="col-lg-12 title" >
				Максимальное количество выполнений:
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <?= $form->field($model, 'minute_1')->input('number', ['min' => 0]); ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($model, 'minutes_5')->input('number', ['min' => 0]); ?>
            </div>
            <div class="col-lg-2">
                <?= $form->field($model, 'hour_1')->input('number', ['min' => 0]); ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'hours_4')->input('number', ['min' => 0]); ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'day_1')->input('number', ['min' => 0]); ?>
            </div>
        </div>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('<i class="fa fa-thumbs-o-up" style="margin-right:15px;"></i> Приступить к выполнению', ['class' => 'btn btn-success btn-lg']); ?>
    </div>
    <?php $form->end(); ?>
</div>
