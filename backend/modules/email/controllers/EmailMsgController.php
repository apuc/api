<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 17.07.2015
 * Time: 17:01
 */

namespace backend\modules\email\controllers;


use yii\web\Controller;

class EmailMsgController extends Controller{
    public function actionIndex()
    {
        return $this->render('index');
    }
} 