<?php
use yii\widgets\LinkPager;

foreach ($news as $new){ ?>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $new->title;?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <?php echo $new->content;?>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <?php echo Yii::$app->formatter->asDate($new->dt_add);?>
        </div><!-- /.box-footer-->
    </div>
<?php }
echo LinkPager::widget([
    'pagination' => $pages,
]);