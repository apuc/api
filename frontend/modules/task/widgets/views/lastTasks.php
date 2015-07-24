<?php
    /**
     * @var $orders array
     * @var $order \frontend\modules\task\models\db\Order
     */
?>
    <div>
        <?php foreach ($orders as $order): ?>
            <div class="row">
                <div class="col-lg-6">
                    <?= $order->url ?>
                </div>
                <div class="col-lg-2">
                    <?= $order->service->name ?>
                </div>
                <div class="col-lg-2">
                    <?= \frontend\modules\task\models\db\Order::getStatuses()[$order->status] ?>
                </div>
                <div class="col-lg-2">
                    <?= $order->members_count ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?=
    \yii\helpers\Html::a(
        "Посмотреть все заказы",
        Yii::$app->urlManager->createUrl(['task/order/view-all']),
        [
            'class' => 'btn btn-default btn-sm',
            'title' => 'Посмотреть все заказы',
        ]);
?>