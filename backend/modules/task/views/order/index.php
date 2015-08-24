<?php

    use yii\grid\GridView;
    use yii\helpers\Html;

    /* @var $model \backend\modules\task\models\db\Order
    /* @var $this yii\web\View */
    /* @var $searchModel backend\modules\task\models\form\OrderSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Orders';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Синхронизировать все статусы', ['synchronize'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [
                'attribute' => 'service_id',
                'format'    => 'text',
                'value'     => function ($model) {
                    return $model->service->name;
                }
            ],
            [
                'attribute' => 'status',
                'format'    => 'text',
                'filter'    => \backend\modules\task\models\db\Order::getStatuses(),
                'value'     => function ($model) {
                    return \backend\modules\task\models\db\Order::getStatuses()[$model->status];
                }
            ],
            'title',
            [
                'attribute' => 'url',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return '<a href="' . $model->url . '" target=_blank>' . $model->url . '</a>';
                }
            ],
            'sum',
            [
                'class'  => \yii\grid\DataColumn::className(),
                'header' => 'Действия',
                'format' => 'html',
                'value'  => function ($model, $index, $widget) {
                    $apply = Html::a(
                        "<span class='glyphicon glyphicon-plus'></span>",
                        Yii::$app->urlManager->createUrl(['task/order/apply', 'id' => $model->id]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Принять',
                        ]);
                    $rejected = Html::a(
                        "<span class='glyphicon glyphicon-minus'></span>",
                        Yii::$app->urlManager->createUrl(['task/ajax/rejected',
                                                          'id' => $model->id
                        ]),
                        [
                            'class' => 'btn btn-default view-rejected-modal',
                            'title' => 'Отклонить',
                        ]);

                    $doneAndHide = Html::a(
                        "<span class='glyphicon glyphicon-remove'></span>",
                        Yii::$app->urlManager->createUrl(['task/order/cancel', 'id' => $model->id,
                                                          'type'                    => \backend\modules\task\models\db\Order::DONE_AND_HIDE
                        ]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Удалить',
                        ]);

                    $stopped = Html::a(
                        "<span class='glyphicon glyphicon-remove'></span>",
                        Yii::$app->urlManager->createUrl(['task/order/cancel', 'id' => $model->id,
                                                          'type'                    => \backend\modules\task\models\db\Order::STOPPED
                        ]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Остановить и вернуть все деньги.',
                        ]);

                    $buttons = '';

                    if ($model->status == \backend\modules\task\models\db\Order::NOT_MODERATED)
                    $buttons = $apply . $rejected;

                    if ($model->status == \backend\modules\task\models\db\Order::DONE)
                        $buttons = $doneAndHide;

                    if ($model->status == \backend\modules\task\models\db\Order::PROCESSED)
                        $buttons = $stopped;

                    return $buttons;
                }
            ],
        ],
    ]); ?>
    <div id="modal-window-rejected" class="well modal-window-rejected">


        <div class="content">
            <a class="close-modal-rejected btn btn-default pull-right" href="#">x</a>

            <div class="row">
                <div class="col-sm-8">
                    <?= 'Введите причину отказа:' ?>
                </div>

            </div>

            <div>
                <?= Html::beginForm('', 'post', ['id' => 'modal-form-rejected']) ?>
            </div>
            <div class="row">
                <?= Html::textarea('rejected-text', '', ['id' => 'rejected-text', 'class' => 'form-control']) ?>
            </div>
            <div class="row">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            </div>
            <div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
    <div class="modal-layout-rejected"></div>
</div>
