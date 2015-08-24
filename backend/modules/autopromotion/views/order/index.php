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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [
                'attribute' => 'status',
                'format'    => 'text',
                'filter'    => \backend\modules\task\models\db\Order::getStatuses(),
                'value'     => function ($model) {
                    return \common\models\db\Promotion::getStatuses()[$model->status];
                }
            ],
            [
                'attribute' => 'url',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return '<a href="' . $model->url . '" target=_blank>' . $model->url . '</a>';
                }
            ],
            [
                'class'  => \yii\grid\DataColumn::className(),
                'header' => 'Действия',
                'format' => 'html',
                'value'  => function ($model, $index, $widget) {
                    $apply = Html::a(
                        "<span class='glyphicon glyphicon-plus'></span>",
                        Yii::$app->urlManager->createUrl(['autopromotion/order/apply', 'id' => $model->id]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Принять',
                        ]);
                    $rejected = Html::a(
                        "<span class='glyphicon glyphicon-minus'></span>",
                        Yii::$app->urlManager->createUrl(['autopromotion/ajax/rejected',
                                                          'id' => $model->id
                        ]),
                        [
                            'class' => 'btn btn-default view-rejected-modal',
                            'title' => 'Отклонить',
                        ]);

                    $buttons = '';

                    if ($model->status == \common\models\db\Promotion::NOT_MODERATED)
                    $buttons = $apply . $rejected;

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
