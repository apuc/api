<?php

    namespace backend\modules\task\controllers;


    use backend\controllers\BackendController;
    use backend\modules\api\classes\Api;
    use backend\modules\task\models\db\Order;
    use yii\web\NotFoundHttpException;

    class TaskController extends BackendController
    {

        public function deleteTask($id)
        {
            $model = $this->findModel($id);

            if (isset($model->foreign_id)) {
                if (Api::deleteTaskByNetwork($model))
                    return true;
            }

            return false;
        }


        protected function findModel($id)
        {
            if (($model = Order::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
    }