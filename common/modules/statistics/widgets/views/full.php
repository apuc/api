<?php
    /**
     * @var $statsForOneDay array
     * @var $statsForSevenDays array
     * @var $statsForOneMonth array
     * @var $statsForAllTime array
     */
?>
<div>
    <div class="col-lg-3">
        <p>Статистика за сутки:</p>

        <p>Выполнено заданий: <?= $statsForOneDay['done1']; ?></p>

        <p>Пставлено зайков: <?= $statsForOneDay['like1']; ?></p>

        <p>Репостов: <?= $statsForOneDay['repost1']; ?></p>

        <p>Подписчиков: <?= $statsForOneDay['subscriber1']; ?></p>

        <p>Друзей: <?= $statsForOneDay['friend1']; ?></p>

        <p>Комментариев: <?= $statsForOneDay['comment1']; ?></p>

        <p>Опросов: <?= $statsForOneDay['interview1']; ?></p>
        <?php
            if (Yii::$app->user->can('administrator'))
                echo '<p>Сумма, руб:' . $statsForOneDay['sum1'] . '</p>';
        ?>
    </div>
    <div class="col-lg-3">
        <p>Статистика за неделю:</p>

        <p>Выполнено заданий: <?= $statsForSevenDays['done7']; ?></p>

        <p>Пставлено зайков: <?= $statsForSevenDays['like7']; ?></p>

        <p>Репостов: <?= $statsForSevenDays['repost7']; ?></p>

        <p>Подписчиков: <?= $statsForSevenDays['subscriber7']; ?></p>

        <p>Друзей: <?= $statsForSevenDays['friend7']; ?></p>

        <p>Комментариев: <?= $statsForSevenDays['comment7']; ?></p>

        <p>Опросов: <?= $statsForSevenDays['interview7']; ?></p>
        <?php
            if (Yii::$app->user->can('administrator'))
                echo '<p>Сумма, руб:' . $statsForSevenDays['sum7'] . '</p>';
        ?>
    </div>
    <div class="col-lg-3">
        <p>Статистика за месяц:</p>

        <p>Выполнено заданий: <?= $statsForOneMonth['done30']; ?></p>

        <p>Пставлено зайков: <?= $statsForOneMonth['like30']; ?></p>

        <p>Репостов: <?= $statsForOneMonth['repost30']; ?></p>

        <p>Подписчиков: <?= $statsForOneMonth['subscriber30']; ?></p>

        <p>Друзей: <?= $statsForOneMonth['friend30']; ?></p>

        <p>Комментариев: <?= $statsForOneMonth['comment30']; ?></p>

        <p>Опросов: <?= $statsForOneMonth['interview30']; ?></p>
        <?php
            if (Yii::$app->user->can('administrator'))
                echo '<p>Сумма, руб:' . $statsForOneMonth['sum30'] . '</p>';
        ?>
    </div>
    <div class="col-lg-3">
        <p>Статистика за все время:</p>

        <p>Выполнено заданий: <?= $statsForAllTime['doneAll']; ?></p>

        <p>Пставлено зайков: <?= $statsForAllTime['likeAll']; ?></p>

        <p>Репостов: <?= $statsForAllTime['repostAll']; ?></p>

        <p>Подписчиков: <?= $statsForAllTime['subscriberAll']; ?></p>

        <p>Друзей: <?= $statsForAllTime['friendAll']; ?></p>

        <p>Комментариев: <?= $statsForAllTime['commentAll']; ?></p>

        <p>Опросов: <?= $statsForAllTime['interviewAll']; ?></p>
        <?php
            if (Yii::$app->user->can('administrator'))
                echo '<p>Сумма, руб:' . $statsForAllTime['sumAll'] . '</p>';
        ?>
    </div>

</div>
