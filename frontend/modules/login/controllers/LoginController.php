<?php
    /**
     * Created by PhpStorm.
     * User: admin
     * Date: 21.06.2015
     * Time: 15:02
     */

    namespace frontend\modules\login\controllers;

    use frontend\modules\login\models\forms\LoginForm;
    use yii\helpers\Url;
    use yii\web\Controller;

    class LoginController extends Controller
    {
        public function actionView()
        {
            $model = new LoginForm();

            if ($model->load(\Yii::$app->request->post()) && $model->login()) {
                //$this->goHome();
                \Yii::$app->getResponse()->redirect(Url::to('profile'));
            } else
                return $this->render('login', ['model' => $model,]);
        }

        public function actionLogout()
        {
            \Yii::$app->user->logout(true);

            \Yii::$app->response->redirect(Url::to('loginto'));
        }
    }