<?php
    /**
     * @var $model \common\models\db\User
     */
$this->title = 'Профиль '.$model->username;
$this->params['breadcrumbs'][] = $this->title;
?>
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
    <div class="box-body">
        <?php
            if(empty($model->photo)){
                echo \yii\helpers\Html::a('Загрузить фото', ['/addphoto']);
            }
            else {
                echo \yii\helpers\Html::img($model->photo, ['width'=>'300px']);
                echo "<br>".\yii\helpers\Html::a('Обновить фото', ['/addphoto']);
            }
        ?>
    </div><!-- /.box-body -->
</div>
<button onclick="document.location.href='/profile/edit'" class="btn btn-block btn-primary btn-sm">Редактировать</button>
