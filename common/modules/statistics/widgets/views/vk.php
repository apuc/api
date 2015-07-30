<?php
    /**
     * @var $statsForOneDay array
     * @var $statsForSevenDays array
     * @var $statsForOneMonth array
     * @var $statsForAllTime array
     */
?>
<div>
    <table class="table table-bordered table-striped">
        <thead class="">
        <td>Статистика Вконтакте</td>
        <td>Статистика за сутки:</td>
        <td>Статистика за неделю:</td>
        <td>Статистика за месяц:</td>
        <td>Статистика за все время:</td>
        </thead>
        <tr>
            <td>Выполнено заданий:</td>
            <td><?= $statsForOneDay['done1']; ?></td>
            <td><?= $statsForSevenDays['done7']; ?></td>
            <td><?= $statsForOneMonth['done30']; ?></td>
            <td><?= $statsForAllTime['doneAll']; ?></td>
        </tr>
        <tr>
            <td>Поставлено лайков:</td>
            <td><?= $statsForOneDay['like1']; ?></td>
            <td><?= $statsForSevenDays['like7']; ?></td>
            <td><?= $statsForOneMonth['like30']; ?></td>
            <td><?= $statsForAllTime['likeAll']; ?></td>
        </tr>
        <tr>
            <td>Репостов:</td>
            <td><?= $statsForOneDay['repost1']; ?></td>
            <td><?= $statsForSevenDays['repost7']; ?></td>
            <td><?= $statsForOneMonth['repost30']; ?></td>
            <td><?= $statsForAllTime['repostAll']; ?></td>
        </tr>
        <tr>
            <td>Подписчиков:</td>
            <td><?= $statsForOneDay['subscriber1']; ?></td>
            <td><?= $statsForSevenDays['subscriber7']; ?></td>
            <td><?= $statsForOneMonth['subscriber30']; ?></td>
            <td><?= $statsForAllTime['subscriberAll']; ?></td>
        </tr>
        <tr>
            <td>Друзей:</td>
            <td><?= $statsForOneDay['friend1']; ?></td>
            <td><?= $statsForSevenDays['friend7']; ?></td>
            <td><?= $statsForOneMonth['friend30']; ?></td>
            <td><?= $statsForAllTime['friendAll']; ?></td>
        </tr>
        <tr>
            <td>Комментариев:</td>
            <td><?= $statsForOneDay['comment1']; ?></td>
            <td><?= $statsForSevenDays['comment7']; ?></td>
            <td><?= $statsForOneMonth['comment30']; ?></td>
            <td><?= $statsForAllTime['commentAll']; ?></td>
        </tr>
        <tr>
            <td>Опросов:</td>
            <td><?= $statsForOneDay['interview1']; ?></td>
            <td><?= $statsForSevenDays['interview7']; ?></td>
            <td><?= $statsForOneMonth['interview30']; ?></td>
            <td><?= $statsForAllTime['interviewAll']; ?></td>
        </tr>
        <?php
            if (Yii::$app->user->can('administrator')):
                ?>
                <tr>
                    <td>
                        Сумма, руб:
                    </td>
                    <td><?= $statsForOneDay['sum1'] ?></td>
                    <td><?= $statsForSevenDays['sum7'] ?></td>
                    <td><?= $statsForOneMonth['sum30'] ?></td>
                    <td><?= $statsForAllTime['sumAll'] ?></td>
                </tr>
            <?php endif; ?>
    </table>
</div>
