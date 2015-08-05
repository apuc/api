<?php

    namespace backend\modules\user\controllers;

    use backend\controllers\BackendController;
    use backend\modules\user\models\forms\SetMoney;
    use backend\modules\user\models\UserSearch;
    use common\models\db\User;
    use Yii;
    use yii\web\NotFoundHttpException;

    /**
     * UserController implements the CRUD actions for User model.
     */
    class UserController extends BackendController
    {

        /**
         * Lists all User models.
         * @return mixed
         */
        public function actionIndex()
        {
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        /**
         * Displays a single User model.
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
         * Finds the User model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return User the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id)
        {
            if (($model = User::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        /**
         * Creates a new User model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate()
        {
            $model = new User();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->generatePassword($model->password);
                $model->created_at = time();
                $model->updated_at = time();
                $model->status = 1;
                $model->getAuthKey();
                $model->save();

                $model->cash_id = md5($model->id);
                $model->save();

                $authManager = \Yii::$app->authManager;
                $role = $authManager->getRole(User::TYPE_USER);
                $authManager->assign($role, $model->id);

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

        /**
         * Updates an existing User model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id)
        {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $model->password = '';
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }

        /**
         * Deletes an existing User model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id)
        {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }

        public function actionSetMoney($id)
        {
            $setMoney = new SetMoney();

            if ($setMoney->load(Yii::$app->request->post()) && $setMoney->validate()){

                $setMoney->apply();

                return $this->redirect('index');
            }

            return $this->render('set_money', ['user' => User::findOne($id), 'model' => new SetMoney()]);
        }
    }
