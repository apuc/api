<?php
    use yii\bootstrap\Collapse;
    use yii\helpers\Html;

    $this->title = 'Автопродвижение в ВКонтакте';
?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?= $this->title; ?></h3>
        </div>
        <div class="box-body no-padding">
            <div class="row">
                <div class="col-md-12">
                    <div role="form">

                        <!--Причины отклонения модерации-->
                        <div class="col-lg-12">
                            <?php
                                if ($model->id):
                                    $comment = \common\models\db\RejectedCommentAuto::find()
                                        ->where(['promotion_id' => $model->id])
                                        ->orderBy('id DESC')
                                        ->one();
                                    ?>

                                    <div class="alert-danger alert fade in">
                                        <?= $comment->text; ?>
                                    </div>
                                <?php endif; ?>

                        </div>
                        <!--end Причины отклонения модерации-->

                        <div class="box-body">
                            <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'promotion-form', 'method' => 'post']); ?>

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
                                    <?= $form->field($model, 'members_count_like')->textInput([
                                        'class' => 'members_count_like form-control',
                                    ]); ?>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">Цена за единицу, руб</label>
                                    <?= Html::textInput('price_per_one_task_like', \common\models\db\Service::findOne(1)->price_per_one_task, [
                                        'class'    => 'price_per_one_task_like form-control',
                                        'readonly' => true,
                                    ]); ?>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">Сумма, руб</label>
                                    <?= Html::textInput('sum_like', 0, [
                                        'class'    => 'sum_like form-control',
                                        'readonly' => true,
                                    ]); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <?= $form->field($model, 'members_count_repost')->textInput([
                                        'class' => 'members_count_repost form-control',
                                    ]); ?>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">Цена за единицу, руб</label>
                                    <?= Html::textInput('price_per_one_task_repost', \common\models\db\Service::findOne(3)->price_per_one_task, [
                                        'class'    => 'price_per_one_task_repost form-control',
                                        'readonly' => true,
                                    ]); ?>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">Сумма, руб</label>
                                    <?= Html::textInput('sum_repost', 0, [
                                        'class'    => 'sum_repost form-control',
                                        'readonly' => true,
                                    ]); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <?= $form->field($model, 'members_count_comment')->textInput([
                                        'class' => 'members_count_comment form-control',
                                    ]); ?>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">Цена за единицу, руб</label>
                                    <?= Html::textInput('price_per_one_task_comment', \common\models\db\Service::findOne(5)->price_per_one_task, [
                                        'class'    => 'price_per_one_task_comment form-control',
                                        'readonly' => true,
                                    ]); ?>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">Сумма, руб</label>
                                    <?= Html::textInput('sum_comment', 0, [
                                        'class'    => 'sum_comment form-control',
                                        'readonly' => true,
                                    ]); ?>
                                </div>
                            </div>

                            <?php
                                $general_setting = "
                        <div class='row'>
                            <div class='col-lg-12'> " .
                                    $form->field($model, 'tag_list')->textInput() . "
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-lg-6'>" .
                                    $form->field($model, 'sex')->dropDownList([
                                        ''  => 'Не выбрано',
                                        '1' => 'Женский',
                                        '2' => 'Мужской',
                                    ]) . "
                            </div>
                            <div class='col-lg-6'>" .
                                    $form->field($model, 'friends_count')->input('number', ['min' => 0]) . "
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-lg-6'>" .
                                    $form->field($model, 'age_min')->input('number', ['min' => 0]) . "
                            </div>
                            <div class='col-lg-6'>" .
                                    $form->field($model, 'age_max')->input('number', ['min' => 0]) . "
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-lg-6'>" .
                                    $form->field($model, 'country')->dropDownList([
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
                                    ]) . "
                            </div>
                            <div class='col-lg-6'>" .
                                    $form->field($model, 'city_text')->textInput() . "
                            </div>
                        </div>
                        ";

                                $like_setting = "
                                <div class='row'>
                                    <div class='col-lg-3'>" .
                                    $form->field($model, 'minute_1_like')->input('number', ['min' => 0]) . "
                                    </div>
                                    <div class='col-lg-2'>" .
                                    $form->field($model, 'minutes_5_like')->input('number', ['min' => 0]) . "
                                    </div>
                                    <div class='col-lg-2'>" .
                                    $form->field($model, 'hour_1_like')->input('number', ['min' => 0]) . "
                                    </div>
                                    <div class='col-lg-2'>" .
                                    $form->field($model, 'hours_4_like')->input('number', ['min' => 0]) . "
                                    </div>
                                    <div class='col-lg-3'>" .
                                    $form->field($model, 'day_1_like')->input('number', ['min' => 0]) . "
                                    </div>
                                </div>
                       ";
                                $repost_setting = "
                            <div class='row' >
                                <div class='col-lg-3' >" .
                                    $form->field($model, 'minute_1_repost')->input('number', ['min' => 0]) . "
                                </div>
                                <div class='col-lg-2'>" .
                                    $form->field($model, 'minutes_5_repost')->input('number', ['min' => 0]) . "
                                </div>
                                <div class='col-lg-2'>" .
                                    $form->field($model, 'hour_1_repost')->input('number', ['min' => 0]) . "
                                </div>
                                <div class='col-lg-2'>" .
                                    $form->field($model, 'hours_4_repost')->input('number', ['min' => 0]) . "
                                </div>
                                <div class='col-lg-3'>" .
                                    $form->field($model, 'day_1_repost')->input('number', ['min' => 0]) . "
                                </div>
                            </div>";
                                $comment_setting = "
                            <div class='row' >
                                <div class='col-lg-3' >" .
                                    $form->field($model, 'minute_1_comment')->input('number', ['min' => 0]) . "
                                </div>
                                <div class='col-lg-2'>" .
                                    $form->field($model, 'minutes_5_comment')->input('number', ['min' => 0]) . "
                                </div>
                                <div class='col-lg-2'>" .
                                    $form->field($model, 'hour_1_comment')->input('number', ['min' => 0]) . "
                                </div>
                                <div class='col-lg-2'>" .
                                    $form->field($model, 'hours_4_comment')->input('number', ['min' => 0]) . "
                                </div>
                                <div class='col-lg-3'>" .
                                    $form->field($model, 'day_1_comment')->input('number', ['min' => 0]) . "
                                </div>
                            </div>";
                            ?>
                            <?= Collapse::widget([
                                'items' => [
                                    [
                                        'label'          => 'Общие настройки',
                                        'content'        => $general_setting,
                                        'contentOptions' => [],
                                        'options'        => [],
                                    ],
                                    [
                                        'label'          => 'Настройка лайков',
                                        'content'        => $like_setting,
                                        'contentOptions' => [],
                                        'options'        => [],
                                    ],
                                    [
                                        'label'          => 'Настройка репостов',
                                        'content'        => $repost_setting,
                                        'contentOptions' => [],
                                        'options'        => [],
                                    ],
                                    [
                                        'label'          => 'Настройка комментариев',
                                        'content'        => $comment_setting,
                                        'contentOptions' => [],
                                        'options'        => [],
                                    ],
                                ],
                            ]); ?>
                            <div class="box-footer">
                                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']); ?>
                            </div>
                            <?php $form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= \frontend\modules\promotion\widgets\AutoPromotionTasks::widget() ?>