<?php

    use yii\helpers\Html;
    use yii\widgets\DetailView;

    /* @var $this yii\web\View */
    /* @var $model common\models\User */

    $this->title = $model->username . " - " . $model->email;
    $this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'money',
            'email:email',
            'created_at:datetime',
            [
                'attribute' => 'status',
                'format'    => 'raw',
                'value'     => ($model->status) ? 'Подтвержден' : 'Не подтвержден'
            ],
            'username',
            //todo оце не робит, но надо бы
            'photo',
        ],
    ]) ?>

</div>
