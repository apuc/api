<?php
    /**
     * @var $orders array
     * @var $promotion \frontend\modules\task\models\db\Order
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
                    <th>Номер старницы</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($promotions as $promotion): ?>
                    <tr>
                        <td><a href="<?= $promotion->url ?>" target="_blank"><?= $promotion->url ?></a></td>
                        <td><?= $promotion->page_id ?></td>
                        <td><span
                                class="label label-success"><?= \common\models\db\Promotion::getStatuses()[$promotion->status] ?></span>
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
                Yii::$app->urlManager->createUrl(['promotion/promotion/view-all']),
                [
                    'class' => 'btn btn-sm btn-default btn-flat pull-right',
                    'title' => 'Посмотреть все заказы',
                ]);
        ?>
    </div>
    <!-- /.box-footer -->
</div><!-- /.box -->