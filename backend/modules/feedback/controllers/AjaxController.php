<?php

    namespace backend\modules\feedback\controllers;


    use backend\controllers\BackendController;
    use backend\modules\feedback\models\db\Feedback;
    use common\classes\Email;
    use yii\web\Controller;

    class AjaxController extends BackendController
    {
        public function actionViewForm()
        {
            $id = \Yii::$app->request->get('id', false);

            echo $this->renderPartial('form', ['model' => Feedback::findOne(['id' => $id])]);
        }

        public function actionSendMail()
        {
            $data = \Yii::$app->request->post('Feedback', false);

            $result = Email::sendFeedbackMail($data);

            if ($result) {
                /**
                 * @var $feedback \backend\modules\feedback\models\db\Feedback
                 */
                $feedback = Feedback::findOne(['id' => $data['id']]);

                $feedback->status = Feedback::PROCESSED;

                if ($feedback->save(false, ['status']))
                    echo 1;
                else
                    echo 0;
            } else
                echo 0;
        }
    }