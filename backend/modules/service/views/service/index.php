<?php

    use yii\helpers\Html;
    use yii\grid\GridView;

    /* @var $this yii\web\View */
    /* @var $searchModel backend\modules\service\models\form\ServiceSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Services';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('На главную', \yii\helpers\Url::toRoute('/adminpage/admin/view'), ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel'  => $searchModel,
        'columns'      => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'model_name',
            'name',
            'minimum_all_likes',
            'minimum_tasks',
            'minimum_likes_per_task',
            'price_per_like',

            [
                'class'  => \yii\grid\DataColumn::className(),
                'header' => 'Действия',
                'format' => 'html',

                'value'  => function ($model, $index, $widget) {
                    $update = Html::a(
                        "<span class='glyphicon glyphicon-pencil'></span>",
                        Yii::$app->urlManager->createUrl(['service/service/update', 'type' => $model->model_name]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Редактировать',
                        ]);

                    return $update;
                }
            ],
        ],
    ]); ?>

</div>
