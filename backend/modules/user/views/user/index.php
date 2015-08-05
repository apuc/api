<?php

    use yii\grid\GridView;
    use yii\helpers\Html;

    /* @var $this yii\web\View */
    /* @var $searchModel backend\modules\user\models\UserSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Пользователи';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'money',
            //'cash_id',
            'email:email',
            'created_at:datetime',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->status ? 'Подтвержден' : 'Не подтвержден';
                },
            ],
            'username',
            [
                'class'  => \yii\grid\DataColumn::className(),
                'header' => 'Действия',
                'format' => 'html',
                'value'  => function ($model, $index, $widget) {
                    $view = Html::a(
                        "<span class='glyphicon glyphicon-eye-open'></span>",
                        Yii::$app->urlManager->createUrl(['user/user/view', 'id' => $model->id]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Показать',
                        ]);
                    $edit = Html::a(
                        "<span class='glyphicon glyphicon-pencil'></span>",
                        Yii::$app->urlManager->createUrl(['user/user/update', 'id' => $model->id]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Изменить',
                        ]);

                    $delete = Html::a(
                        "<span class='glyphicon glyphicon-remove-circle'></span>",
                        Yii::$app->urlManager->createUrl(['user/user/delete', 'id' => $model->id]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Удалить',
                        ]);

                    $money = Html::a(
                        "<span class='glyphicon glyphicon-ruble'></span>",
                        Yii::$app->urlManager->createUrl(['user/user/set-money', 'id' => $model->id]),
                        [
                            'class' => 'btn btn-default',
                            'title' => 'Указать кол-во денег на счету',
                        ]);

                    $buttons = $money . $view . $edit . $delete;

                    return $buttons;
                }
            ],
        ],
    ]); ?>

</div>
