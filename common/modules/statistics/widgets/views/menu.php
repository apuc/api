<div class="row">
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-checkmark"></i></span>


            <div class="info-box-content">
                <span class="info-box-text">Заказов выполнено за 24 часа</span>
                <span class="info-box-number"><?= $done; ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Подписчиков привлечено за 24 часа</span>
                <span class="info-box-number"><?= $subscriber ;?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-heart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Лайков поставлено за 24 часа</span>
                <span class="info-box-number"><?= $like; ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-arrow-return-left"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Репостов за 24 часа</span>
                <span class="info-box-number"><?= $repost; ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
