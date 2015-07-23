<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 23.07.2015
 * Time: 14:18
 */

namespace frontend\modules\mainpage\controllers;

use common\classes\Debag;
use yii\web\Controller;
use Yii;

class MainpageController extends Controller
{
    public $layout;

    public function actionIndex()
    {
        if(empty(Yii::$app->user->identity)){
            $this->layout = "no_login";
        }
        return $this->render('index');
    }
} 