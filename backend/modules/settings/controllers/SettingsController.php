<?php

    namespace backend\modules\settings\controllers;

    use backend\controllers\BackendController;
    use backend\modules\settings\models\form\Form;

    class SettingsController extends BackendController
    {
        public function actionView(){

            $form = new Form();

            if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
                $form->save();

                \Yii::$app->session->setFlash('message', ['type'    => 'success',
                                                         'message' => 'Настройки сохранены.']);
            }

            return $this->render('settings', ['model'=> $form]);
        }
    }