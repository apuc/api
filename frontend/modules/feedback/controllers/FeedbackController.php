<?php
    namespace frontend\modules\feedback\controllers;

    use common\classes\Email;

    use frontend\modules\feedback\models\db\Feedback;
    use frontend\modules\feedback\models\forms\FeedbackForm;
    use Yii;
    use yii\base\Controller;

    class FeedbackController extends Controller
    {

        public function actionIndex()
        {
            $model = new FeedbackForm();
            $feedback = new Feedback();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                Yii::$app->session->setFlash('message', ['type'    => 'success',
                                                         'message' => 'Ваше сообщение отправлено администрации сайта']);

                $feedback->status = 0;
                $feedback->created_at = time();
                $feedback->updated_at = time();
                $feedback->name = $model->name;
                $feedback->email = $model->email;
                $feedback->text = $model->text;
                $feedback->save();
                Email::sendFeedBackToUser($feedback);

                return $this->render('index', [
                    'model' => new FeedbackForm(),
                ]);
            } else {
                return $this->render('index', [
                    'model' => $model,
                ]);
            }
        }
    }