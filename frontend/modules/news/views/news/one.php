<div class="box news">
    <?php

        echo $onenews->title;
        echo $onenews->content;
        echo Yii::$app->formatter->asDate($onenews->dt_add);
    ?>
</div>
