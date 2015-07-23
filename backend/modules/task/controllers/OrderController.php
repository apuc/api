<?php

    namespace backend\modules\task\controllers;

    use backend\modules\api\classes\VK;
    use common\models\User;
    use Yii;
    use backend\modules\task\models\db\Order;
    use backend\modules\task\models\form\OrderSearch;
    use yii\db\Exception;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;

    /**
     * OrderController implements the CRUD actions for Order model.
     */
    class OrderController extends Controller
    {
        /**
         * Lists all Order models.
         * @return mixed
         */
        public function actionIndex()
        {
            $searchModel = new OrderSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        /**
         * Displays a single Order model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id)
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }

        /**
         * Updates an existing Order model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionApply($id)
        {
            $model = $this->findModel($id);

            $db = Yii::$app->db;

            $model->status = Order::PROCESSED;
            $transaction = $db->beginTransaction();
            try {
                $model->save();

                $id = VK::setTask($model);
                if ($id === false)
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

        /**
         * Finds the Order model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Order the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id)
        {
            if (($model = Order::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
    }
