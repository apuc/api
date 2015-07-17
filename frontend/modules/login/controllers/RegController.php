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
use common\models\RegForm;
use frontend\modules\login\models\db\User;
use yii\web\Controller;

class RegController extends Controller{
    public function actionIndex()
    {
        $model = new RegForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены
            $user = new User();
            //Debag::prn($user);
            $user->username = $model->username;
            $user->email = $model->email;
            $user->setPassword($model->password_hash);
            $user->generateAuthKey();
            $user->created_at = time();
            $user->status = 0;
            //$user->save();
            Debag::prn(Yii::$app->mailer);
            // делаем что-то полезное с $model ...

            return $this->render('index', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('form', ['model' => $model]);
        }
    }
} 