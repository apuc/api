<?php
    /**
     * @var $provider \yii\data\ActiveDataProvider
     * @var $model \frontend\modules\task\models\db\Order
     */
    use yii\grid\DataColumn;
    use yii\helpers\Html;

?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Все задания<?= $this->title; ?></h3>
    </div>
    <div class="box-body no-padding">
        <div class="row">
            <div class="col-md-12">
                <form role="form">
                    <div class="box-body">
                        <div class="table-responsive">
                            <?php
                                echo \yii\grid\GridView::widget([
                                    'dataProvider' => $provider,
                                    'tableOptions' => [
                                        'class' => 'table table-striped table-bordered',
                                    ],
                                    'columns'      => [
                                        [
                                            'attribute' => 'service_id',
                                            'value'     => function ($model) {
                                                return $model->service->name;
                                            }
                                        ],
                                        //'date:datetime',
                                        [
                                            'attribute' => 'status',
                                            'value'     => function ($model) {
                                                return $model::getStatuses()[$model->status];
                                            }
                                        ],
                                        //'url',
                                        [
                                            'attribute' => 'title',
                                            'format'    => 'raw',
                                            'value'     => function ($model) {
                                                return '<a href="' . $model->url . '" target=_blank>' . $model->title . '</a>';
                                            }
                                        ],
                                        'sum',
                                        [
                                            'class'  => DataColumn::className(),
                                            'header' => 'Действия',
                                            'format' => 'html',

                                            'value'  => function ($model, $index, $widget) {

                                                $repeat = Html::a(
                                                    "<span class='glyphicon glyphicon-repeat'></span>",
                                                    Yii::$app->urlManager->createUrl(['task/order/repeat',
                                                                                      'id' => $model->id]),
                                                    [
                                                        'class' => 'btn btn-default repeat',
                                                        'title' => 'Перезапустить задачу',
                                                    ]);

                                                $edit = Html::a(
                                                    "<span class='glyphicon glyphicon-edit'></span>",
                                                    Yii::$app->urlManager->createUrl(
                                                        [
                                                            'task/order/update',
                                                            'type' => $model->service->model_name,
                                                            'id'   => $model->id,
                                                        ]
                                                    ),
                                                    [
                                                        'class' => 'btn btn-default',
                                                        'title' => 'Редактировать',
                                                    ]);


                                                $buttons =
                                                    "<div class='row text-center'>" .
                                                    $repeat
                                                    . "</div>";

                                                if ($model->status == \frontend\modules\task\models\db\Order::DONE ||
                                                    $model->status == \frontend\modules\task\models\db\Order::DONE_AND_HIDE
                                                ) {
                                                    return "<div class='row text-center'>" .
                                                    $repeat
                                                    . "</div>";;
                                                }

                                                if ($model->status == \frontend\modules\task\models\db\Order::REJECTED)
                                                    return "<div class='row text-center'>" .
                                                    $edit
                                                    . "</div>";

                                                return false;
                                            }
                                        ]
                                    ]
                                ])
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
