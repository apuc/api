<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 17.07.2015
 * Time: 13:55
 */

namespace frontend\modules\login\controllers;

use Yii;
use common\classes\Debag;
use common\classes\Email;
use common\models\RegForm;
use frontend\modules\login\models\db\User;
use yii\web\Controller;

class RegController extends Controller
{
    public $layout = 'no_login';
    public function actionIndex()
    {
        $model = new RegForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены
            $user = new User();
            //Debag::prn($user);
            $user->username = $model->username;
            $user->email = $model->email;
            $user->generatePassword($model->password);
            $user->created_at = time();
            $user->updated_at = time();
            $user->status = 0;
            $user->getAuthKey();
            $user->save();


            $authManager = \Yii::$app->authManager;
            $role = $authManager->getRole(User::TYPE_USER);
            $authManager->assign($role, $user->id);
            Email::sendActivateMail($user);
            $this->layout = "no_login";
            return $this->render('index', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            $this->layout = "login";
            return $this->render('form', ['model' => $model]);
        }
    }

    public function actionActivate()
    {
        $this->layout = "no_login";
        if(isset($_GET['key'])){
            $user = \common\models\User::findIdentity($_GET['id']);
            $user->status = 1;
            $user->update();
            return $this->render('activate');
        }
    }

    public function actionForgot(){
        $this->layout = "no_login";
        if(Yii::$app->request->post()){
            $user = \common\models\User::findByEmail(Yii::$app->request->post()['email']);
            if(!empty($user)){
                $pass = $user->generateRandomPassword();
                $user->update();
                $msg = "<h3>Новый пароль выслан Вам на указанный Email</h3>";
                Email::sendForgotPass(Yii::$app->request->post()['email'], $pass);
            }
            else {
                $msg = "<h3>Пользователь с таким паролем не найден</h3>";
            }
            return $this->render('new_pass', ['msg'=>$msg]);
        }
        else {
            return $this->render('forgot');
        }
    }
} 