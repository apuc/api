<?php
    /**
     * @var $statsForOneDayTwit array
     * @var $statsForSevenDaysTwit array
     * @var $statsForOneMonthTwit array
     * @var $statsForAllTimeTwit array
     */
?>
<div>
    <table class="table table-bordered table-striped">
        <thead class="">
        <td>Статистика Twitter</td>
        <td>Статистика за сутки:</td>
        <td>Статистика за неделю:</td>
        <td>Статистика за месяц:</td>
        <td>Статистика за все время:</td>
        </thead>
        <tr>
            <td>Выполнено заданий:</td>
            <td><?= $statsForOneDayTwit['done1']; ?></td>
            <td><?= $statsForSevenDaysTwit['done7']; ?></td>
            <td><?= $statsForOneMonthTwit['done30']; ?></td>
            <td><?= $statsForAllTimeTwit['doneAll']; ?></td>
        </tr>
        <tr>
            <td>Ретвитов:</td>
            <td><?= $statsForOneDayTwit['retwit1']; ?></td>
            <td><?= $statsForSevenDaysTwit['retwit7']; ?></td>
            <td><?= $statsForOneMonthTwit['retwit30']; ?></td>
            <td><?= $statsForAllTimeTwit['retwitAll']; ?></td>
        </tr>
        <tr>
            <td>Подписчиков:</td>
            <td><?= $statsForOneDayTwit['subscriber1']; ?></td>
            <td><?= $statsForSevenDaysTwit['subscriber7']; ?></td>
            <td><?= $statsForOneMonthTwit['subscriber30']; ?></td>
            <td><?= $statsForAllTimeTwit['subscriberAll']; ?></td>
        </tr>
        <tr>
            <td>Избраное:</td>
            <td><?= $statsForOneDayTwit['favorite1']; ?></td>
            <td><?= $statsForSevenDaysTwit['favorite7']; ?></td>
            <td><?= $statsForOneMonthTwit['favorite30']; ?></td>
            <td><?= $statsForAllTimeTwit['favoriteAll']; ?></td>
        </tr>
        <?php
            if (Yii::$app->user->can('administrator')):
                ?>
                <tr>
                    <td>
                        Сумма, руб:
                    </td>
                    <td><?= $statsForOneDayTwit['sum1'] ?></td>
                    <td><?= $statsForSevenDaysTwit['sum7'] ?></td>
                    <td><?= $statsForOneMonthTwit['sum30'] ?></td>
                    <td><?= $statsForAllTimeTwit['sumAll'] ?></td>
                </tr>
            <?php endif; ?>
    </table>
</div>