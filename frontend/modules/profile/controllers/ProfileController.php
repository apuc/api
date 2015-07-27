<?php

namespace frontend\modules\profile\controllers;

use frontend\modules\profile\classes\UploadPhoto;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        return $this->render('view', ['model' => $user]);
    }

    public function actionEdit(){
        $user = Yii::$app->user->identity;

        if(Yii::$app->request->post()){
            $u = Yii::$app->request->post();
            $user->username = $u['User']['username'];
            $user->email = $u['User']['email'];
            if(!empty($u['User']['password'])){
                $user->generatePassword($u['User']['password']);
            }
            $user->update();
            return $this->render('view', ['model' => $user]);
        }
        else {
            $user->password = '';
            return $this->render('edit', ['model' => $user]);
        }

    }

    public function actionAddphoto(){
        $model = new UploadPhoto();
        $user = Yii::$app->user->identity;

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                $model->file->saveAs('img/ava/' . $user->id . '.' . $model->file->extension);
            }
            $user->photo = 'img/ava/' . $user->id . '.' . $model->file->extension;
            $user->update();
            return $this->redirect(['/profile']);
        }
        else {
            return $this->render('addphoto', ['model' => $model]);
        }


    }
} 