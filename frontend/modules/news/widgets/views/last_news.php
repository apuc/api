<?php
/**
 * @var $news array
 */
?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Новости</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                <?php
                foreach($news as $new){?>

                <li class="item">
                   <!-- <div class="product-img">
                        <img src="dist/img/default-50x50.gif" alt="Product Image">
                    </div>-->
                    <div class="product-info">
                        <a href="<?=Yii::$app->urlManager->createUrl("news/news/one-news?id=$new->id");?>" class="product-title"><?php echo $new->title;?></a>
                        <span class="product-description">
                          <?php echo $new->short_text;?>
                        </span>
                    </div>
                </li><!-- /.item -->


                <?php } ?>
            </ul>
        </div><!-- /.box-body -->
        <div class="box-footer text-center">
            <a href=<?= \Yii::$app->urlManager->createUrl('news/news/all-news');?> class="uppercase">Все новости</a>
        </div><!-- /.box-footer -->
    </div>



