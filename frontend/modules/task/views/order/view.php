<?php
    /**
     * @var $this \yii\web\View
     * @var $type string
     * @var $model \frontend\modules\task\models\db\Order
     */

    $this->title = $model->service->name
?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Накрутка - <?= $this->title; ?></h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
</div>

<?= \frontend\modules\task\widgets\LastTasks::widget(['type' => $type]) ?>
