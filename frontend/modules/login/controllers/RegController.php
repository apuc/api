<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 17.07.2015
 * Time: 13:55
 */

namespace frontend\modules\login\controllers;
use yii\web\Controller;

class RegController extends Controller{
    public function actionIndex()
    {
        return $this->render('index');
    }
} 