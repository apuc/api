<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\task\models\db\Order */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'service_id',
            'date',
            'status',
            'kind',
            'title',
            'url:url',
            'members_count',
            'cost',
            'tag_list',
            'sex',
            'age_min',
            'age_max',
            'friends_count',
            'country',
            'city_text',
            'city',
            'minute_1',
            'minutes_5',
            'hour_1',
            'hours_4',
            'day_1',
            'sum',
        ],
    ]) ?>

</div>
