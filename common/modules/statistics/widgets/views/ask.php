<?php
    /**
     * @var $statsForOneDayAsk array
     * @var $statsForSevenDaysAsk array
     * @var $statsForOneMonthAsk array
     * @var $statsForAllTimeAsk array
     */
?>
<div>
    <table class="table table-bordered table-striped">
        <thead class="">
        <td>Статистика Ask</td>
        <td>Статистика за сутки:</td>
        <td>Статистика за неделю:</td>
        <td>Статистика за месяц:</td>
        <td>Статистика за все время:</td>
        </thead>
        <tr>
            <td>Выполнено заданий:</td>
            <td><?= $statsForOneDayAsk['done1']; ?></td>
            <td><?= $statsForSevenDaysAsk['done7']; ?></td>
            <td><?= $statsForOneMonthAsk['done30']; ?></td>
            <td><?= $statsForAllTimeAsk['doneAll']; ?></td>
        </tr>
        <tr>
            <td>Поставлено лайков:</td>
            <td><?= $statsForOneDayAsk['like1']; ?></td>
            <td><?= $statsForSevenDaysAsk['like7']; ?></td>
            <td><?= $statsForOneMonthAsk['like30']; ?></td>
            <td><?= $statsForAllTimeAsk['likeAll']; ?></td>
        </tr>
        <?php
            if (Yii::$app->user->can('administrator')):
                ?>
                <tr>
                    <td>
                        Сумма, руб:
                    </td>
                    <td><?= $statsForOneDayAsk['sum1'] ?></td>
                    <td><?= $statsForSevenDaysAsk['sum7'] ?></td>
                    <td><?= $statsForOneMonthAsk['sum30'] ?></td>
                    <td><?= $statsForAllTimeAsk['sumAll'] ?></td>
                </tr>
            <?php endif; ?>
    </table>
</div>