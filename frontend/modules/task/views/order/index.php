<?php
    /**
     * @var $provider \yii\data\ActiveDataProvider
     * @var $model \frontend\modules\task\models\db\Order
     */
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
                        <?php
                            echo \yii\grid\GridView::widget([
                                'dataProvider' => $provider,
                                'tableOptions' => [
                                    'class' => 'table-striped table-bordered',
                                ],
                                'columns'      => [
                                    [
                                        'attribute' => 'service_id',
                                        'value'     => function ($model) {
                                            return $model->service->name;
                                        }
                                    ],
                                    'date:datetime',
                                    [
                                        'attribute' => 'status',
                                        'value'     => function ($model) {
                                            return $model::getStatuses()[$model->status];
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
                                ]
                            ])
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
