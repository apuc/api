<?php
    /**
     * @var $this \yii\web\View
     * @var $type string
     * @var $model \frontend\modules\task\models\db\Order
     */

    $this->title = $model->service->name
?>

<?= $this->title ?>

<?php
    if (Yii::$app->session->getFlash('done')) {
        echo "<script>alert(" . Yii::$app->session->getFlash('done') . ")</script>";
    }
?>

<?= $this->render('_form', ['model' => $model]) ?>

<?= \frontend\modules\task\widgets\LastTasks::widget() ?>
