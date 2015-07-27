<?php

    namespace backend\modules\task\controllers;

    use backend\controllers\BackendController;
    use backend\modules\api\classes\Api;
    use backend\modules\api\classes\AskFM;
    use backend\modules\api\classes\Instagram;
    use backend\modules\api\classes\Twitter;
    use backend\modules\api\classes\VK;
    use backend\modules\task\models\db\Order;
    use backend\modules\task\models\form\OrderSearch;
    use common\classes\Debag;
    use common\models\db\OrderSynchronize;
    use common\models\db\Service;
    use Yii;
    use yii\db\Exception;
    use yii\web\NotFoundHttpException;

    /**
     * OrderController implements the CRUD actions for Order model.
     */
    class OrderController extends BackendController
    {
        public function actionIndex()
        {
            $searchModel = new OrderSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        public function actionView($id)
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }

        protected function findModel($id)
        {
            if (($model = Order::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        /**
         * @return bool
         */
        public function actionSynchronize()
        {
            OrderSynchronize::synchronizeStatuses();

            return $this->redirect(['index']);
        }

        public function actionApply($id)
        {
            $model = $this->findModel($id);

            $db = Yii::$app->db;

            $model->status = Order::PROCESSED;

            $network = $model->service->network;
            $transaction = $db->beginTransaction();
            try {
                $model->save();

                $id = false;

                if ($network == Service::VK)
                    $id = VK::setTask($model);
                if ($network == Service::INSTAGRAM)
                    $id = Instagram::setTask($model);
                if ($network == Service::TWITTER)
                    $id = Twitter::setTask($model);
                if ($network == Service::ASKFM)
                    $id = AskFM::setTask($model);

                if ($id == false)
                    throw new Exception('Упали');

                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
            }

            $model->foreign_id = $id;
            $model->save();

            return $this->redirect(['index']);
        }

        /**
         * Deletes an existing Order model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionCancel($id)
        {
            $model = $this->findModel($id);
            $user = $model->user;

            $user->money += $model->sum;

            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                $user->save();
                $model->delete();

                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
            }

            return $this->redirect(['index']);
        }

        public function actionDelete($id)
        {
            $model = $this->findModel($id);

            if (isset($model->foreign_id)) {
                $result = Api::deleteTask($model->foreign_id);

                return $this->redirect(['index']);
            }
        }
    }
