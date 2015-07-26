<?php
    /**
     * @var $orders array
     * @var $order \frontend\modules\task\models\db\Order
     */
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Последние задания по накрутке</h3>

        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                <tr>
                    <th>Ссылка</th>
                    <th>Тип</th>
                    <th>Статус</th>
                    <th>Кол-во</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><a href="<?= $order->url ?>"><?= $order->url ?></a></td>
                        <td><?= $order->service->name ?></td>
                        <td><span
                                class="label label-success"><?= \frontend\modules\task\models\db\Order::getStatuses()[$order->status] ?></span>
                        </td>
                        <td>
                            <div class="sparkbar" data-color="#00a65a"
                                 data-height="20"><?= $order->members_count ?></div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <?=
            \yii\helpers\Html::a(
                "Посмотреть все заказы",
                Yii::$app->urlManager->createUrl(['task/order/view-all']),
                [
                    'class' => 'btn btn-sm btn-default btn-flat pull-right',
                    'title' => 'Посмотреть все заказы',
                ]);
        ?>
    </div>
    <!-- /.box-footer -->
</div><!-- /.box -->