<?php

    namespace backend\modules\autopromotion\controllers;


    use backend\controllers\BackendController;
    use common\models\db\Promotion;
    use yii\web\NotFoundHttpException;

    class TaskController extends BackendController
    {
        protected function findModel($id)
        {
            if (($model = Promotion::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
    }