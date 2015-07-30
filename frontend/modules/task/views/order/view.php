<?php
    /**
     * @var $this \yii\web\View
     * @var $type string
     * @var $model \frontend\modules\task\models\db\Order
     */


    use kartik\growl\Growl;

    $this->title = $model->service->name
?>


<?php
    if (Yii::$app->session->hasFlash('message')) {
        $message = Yii::$app->session->getFlash('message');
        echo Growl::widget([
            'type'          => $message['type'],
            'title'         => 'Уведомление',
            'icon'          => 'fa fa-info',
            'body'          => $message['message'],
            'showSeparator' => true,
            'delay'         => 500,
            'pluginOptions' => [
                'delay'     => 4000, //This delay is how long the message shows for
                'placement' => [
                    'from'  => 'bottom',
                    'align' => 'right',
                ]
            ]
        ]);
    }
?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Накрутка - <?= $this->title; ?></h3>
    </div>
    <div class="box-body no-padding">
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
</div>

<?= \frontend\modules\task\widgets\LastTasks::widget() ?>
