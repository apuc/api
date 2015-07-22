<?php
    /**
     * @var $model \common\models\User
     */
?>

    <h2>Ваш профиль</h2>
<?= \yii\helpers\Html::a('лайки', \yii\helpers\Url::to(['/task/order/view-page', 'type' => 'like'])) ?>
<?= $model->email; ?>