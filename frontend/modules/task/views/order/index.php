<?php
    /**
     * @var $provider \yii\data\ActiveDataProvider
     * @var $model \frontend\modules\task\models\db\Order
     */
?>
<?php
    echo \yii\grid\GridView::widget([
        'dataProvider' => $provider,
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
                'format'      => 'raw',
                'value'     => function ($model) {
                    return '<a href="'.$model->url.'" target=_blank>' . $model->url . '</a>';
                }
            ],
            'sum',
        ]
    ])
?>