<?php
    /**
     * Форма добавления задания по накрутке лайков
     *
     * @var $model \frontend\modules\task\models\db\Order
     */

    use yii\helpers\Html;

?>

<?php $form = \yii\widgets\ActiveForm::begin(['id' => 'like-form']); ?>
<?= $form->field($model, 'kind', ['template' => ''])->hiddenInput(); ?>
<?= $form->field($model, 'service_id', ['template' => ''])->hiddenInput(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'title')->textInput(); ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'url')->textInput(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'members_count')->textInput([
                'class' => 'members_count form-control',

            ]); ?>
        </div>
        <div class="col-lg-4">
            <label class="control-label">Цена за единицу, руб</label>
            <?= Html::textInput('price_per_one_task', $model->service->price_per_one_task, [
                'class'    => 'price_per_one_task form-control',
                'readonly' => true
            ]); ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'sum')->textInput([
                'readonly' => true,
                'class'    => 'sum form-control',
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'tag_list')->textInput(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'sex')->dropDownList([
                ''  => 'Не выбрано',
                '1' => 'Женский',
                '2' => 'Мужской',
            ]); ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'age_min')->input('number', ['min' => 0]); ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'age_max')->input('number', ['min' => 0]); ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'friends_count')->input('number', ['min' => 0]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'country')->dropDownList([
                ''   => 'Не выбрано',
                '1'  => 'Россия',
                '2'  => 'Украина',
                '3'  => 'Беларусь',
                '4'  => 'Казахстан',
                '5'  => 'Азербайджан',
                '6'  => 'Армения',
                '7'  => 'Грузия',
                '8'  => 'Израиль',
                '9'  => 'США',
                '65' => 'Германия',
                '11' => 'Кыргызстан',
                '12' => 'Латвия',
                '13' => 'Литва',
                '14' => 'Эстония',
                '15' => 'Молдова',
                '16' => 'Таджикистан',
                '17' => 'Туркменистан',
                '18' => 'Узбекистан',
            ]); ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'city_text')->textInput(); ?>
        </div>
    </div>
<? //= $form->field($model, 'city')->textInput(); ?>
    <div class="row down">
        <div class="col-lg-3">
            <?= $form->field($model, 'minute_1')->input('number', ['min' => 0]); ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'minutes_5')->input('number', ['min' => 0]); ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'hour_1')->input('number', ['min' => 0]); ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'hours_4')->input('number', ['min' => 0]); ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'day_1')->input('number', ['min' => 0]); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']); ?>
    </div>
<?php $form->end(); ?>