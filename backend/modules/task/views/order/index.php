<?php

    use yii\helpers\Html;
    use yii\grid\GridView;

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
                    $cancel = Html::a(
                        "<span class='glyphicon glyphicon-minus'></span>",
                        Yii::$app->urlManager->createUrl(['task/order/cancel', 'id' => $model->id]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Отклонить',
                        ]);

                    $delete = Html::a(
                        "<span class='glyphicon glyphicon-remove'></span>",
                        Yii::$app->urlManager->createUrl(['task/order/delete', 'id' => $model->id]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Удалить',
                        ]);

                    $buttons = '';

                    if ($model->status == \backend\modules\task\models\db\Order::NOT_MODERATED)
                        $buttons = $apply . $cancel;

                    if ($model->status == \backend\modules\task\models\db\Order::DONE)
                        $buttons = $delete;

                    return $buttons;
                }
            ],
        ],
    ]); ?>

</div>
