<?php

    use yii\grid\DataColumn;
    use yii\helpers\Html;
    use yii\grid\GridView;

    /* @var $this yii\web\View */
    /* @var $searchModel backend\modules\feedback\models\form\FeedbackSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Обратная связь';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('Create Feedback', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'email:email',
            [
                'attribute' => 'name',
                'filter' => false,
            ],
            [
                'attribute'=>'text',
                'filter' => false,
            ],
            [
                'attribute' => 'status',
                'filter'    => \backend\modules\feedback\models\db\Feedback::getStatusList(),
                'value'     => function ($model) {
                    return $model->getStatus();
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => false,
            ],
            // 'updated_at',

            //            ['class' => 'yii\grid\ActionColumn'],

            [
                'class'  => DataColumn::className(),
                'header' => 'Действия',
                'format' => 'html',

                'value'  => function ($model, $index, $widget) {
                    $delete = Html::a(
                        "<span class='glyphicon glyphicon-trash'></span>",
                        Yii::$app->urlManager->createUrl(['feedback/feedback/delete', 'id' => $model->id]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Обработано без ответа',
                        ]);

                    $buttons =
                        "<div class='row text-center'>" .
                        Html::a(
                            "<span class='glyphicon glyphicon-envelope'></span>",
                            Yii::$app->urlManager->createUrl(['feedback/ajax/view-form', 'id' => $model->id]),
                            [
                                'class' => 'btn btn-default view-action-btn',
                                'title' => 'Ответить',
                            ])
                        .
                        $delete
                        . "</div>";

                    return $model->status ? $delete : $buttons;
                }
            ],
        ]
    ]); ?>

</div>
<div id="modal-window" class="well modal-window">
    <a class="close-modal btn btn-default pull-right" href="#">x</a>

    <div class="content">

    </div>
</div>
<div class="modal-layout"></div>