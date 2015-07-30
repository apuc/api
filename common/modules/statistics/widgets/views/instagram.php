<?php
    /**
     * @var $statsForOneDayIns array
     * @var $statsForSevenDaysIns array
     * @var $statsForOneMonthIns array
     * @var $statsForAllTimeIns array
     */
?>
<div>
    <table class="table table-bordered table-striped">
        <thead class="">
        <td>Статистика Instagram</td>
        <td>Статистика за сутки:</td>
        <td>Статистика за неделю:</td>
        <td>Статистика за месяц:</td>
        <td>Статистика за все время:</td>
        </thead>
        <tr>
            <td>Выполнено заданий:</td>
            <td><?= $statsForOneDayIns['done1']; ?></td>
            <td><?= $statsForSevenDaysIns['done7']; ?></td>
            <td><?= $statsForOneMonthIns['done30']; ?></td>
            <td><?= $statsForAllTimeIns['doneAll']; ?></td>
        </tr>
        <tr>
            <td>Поставлено лайков:</td>
            <td><?= $statsForOneDayIns['like1']; ?></td>
            <td><?= $statsForSevenDaysIns['like7']; ?></td>
            <td><?= $statsForOneMonthIns['like30']; ?></td>
            <td><?= $statsForAllTimeIns['likeAll']; ?></td>
        </tr>
        <tr>
            <td>Подписчиков:</td>
            <td><?= $statsForOneDayIns['subscriber1']; ?></td>
            <td><?= $statsForSevenDaysIns['subscriber7']; ?></td>
            <td><?= $statsForOneMonthIns['subscriber30']; ?></td>
            <td><?= $statsForAllTimeIns['subscriberAll']; ?></td>
        </tr>
        <?php
            if (Yii::$app->user->can('administrator')):
                ?>
                <tr>
                    <td>
                        Сумма, руб:
                    </td>
                    <td><?= $statsForOneDayIns['sum1'] ?></td>
                    <td><?= $statsForSevenDaysIns['sum7'] ?></td>
                    <td><?= $statsForOneMonthIns['sum30'] ?></td>
                    <td><?= $statsForAllTimeIns['sumAll'] ?></td>
                </tr>
            <?php endif; ?>
    </table>
</div>