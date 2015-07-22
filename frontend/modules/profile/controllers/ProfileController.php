<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 21.07.2015
 * Time: 16:32
 */

namespace frontend\modules\profile\controllers;


use common\classes\Debag;
use common\models\User;
use yii\web\Controller;
use Yii;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        return $this->render('view', ['model' => $user]);
    }

    public function actionEdit(){
        return $this->render('edit');
    }
} 