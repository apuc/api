<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Ваш профиль</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->username; ?>
    </div><!-- /.box-body -->
    <div class="box-body">
        <?= $model->email; ?>
    </div><!-- /.box-body -->
</div>
<button class="btn btn-block btn-primary btn-sm">Редактировать</button>
