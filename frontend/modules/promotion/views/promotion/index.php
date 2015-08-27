<?php
    /**
     * @var $provider \yii\data\ActiveDataProvider
     * @var $model    \frontend\modules\task\models\db\Order
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
                                            'attribute' => 'status',
                                            'value'     => function ($model) {
                                                return $model::getStatuses()[$model->status];
                                            },
                                        ],
                                        [
                                            'attribute' => 'title',
                                            'format'    => 'raw',
                                            'value'     => function ($model) {
                                                return '<a href="' . $model->url . '" target=_blank>' . $model->url . '</a>';
                                            },
                                        ],
                                        [
                                            'class'  => DataColumn::className(),
                                            'header' => 'Действия',
                                            'format' => 'html',

                                            'value'  => function ($model, $index, $widget) {

                                                $start = Html::a(
                                                    "<span class='glyphicon glyphicon-play'></span>",
                                                    Yii::$app->urlManager->createUrl(['promotion/promotion/start',
                                                        'id' => $model->id]),
                                                    [
                                                        'class' => 'btn btn-default',
                                                        'title' => 'Запустить задачу',
                                                    ]);

                                                $stop = Html::a(
                                                    "<span class='glyphicon glyphicon-stop'></span>",
                                                    Yii::$app->urlManager->createUrl(['promotion/promotion/stop',
                                                        'id' => $model->id,]),
                                                    [
                                                        'class' => 'btn btn-default',
                                                        'title' => 'Остановить выполнение',
                                                    ]);

                                                $edit = Html::a(
                                                    "<span class='glyphicon glyphicon-edit'></span>",
                                                    Yii::$app->urlManager->createUrl(['promotion/promotion/view-promotion',
                                                        'type' => 'vk',
                                                        'id' => $model->id,]),
                                                    [
                                                        'class' => 'btn btn-default',
                                                        'title' => 'Остановить выполнение',
                                                    ]);

                                                if ($model->status == \common\models\db\Promotion::MODERATED) {
                                                    return "<div class='row text-center'>" .
                                                    $stop
                                                    . "</div>";
                                                }

                                                if ($model->status == \common\models\db\Promotion::STOPPED)
                                                    return "<div class='row text-center'>" .
                                                    $start
                                                    . "</div>";

                                                if ($model->status == \common\models\db\Promotion::REJECTED)
                                                    return "<div class='row text-center'>" .
                                                    $edit
                                                    . "</div>";

                                                return false;
                                            },
                                        ],
                                    ],
                                ])
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
