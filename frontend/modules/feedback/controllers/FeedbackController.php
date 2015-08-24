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
            if (empty(Yii::$app->user->identity)) {
                $this->layout = "no_login";
            }

            $model = new FeedbackForm();
            $feedback = new Feedback();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $feedback->status = 0;
                $feedback->created_at = time();
                $feedback->updated_at = time();
                $feedback->name = $model->name;
                $feedback->email = $model->email;
                $feedback->text = $model->text;

                Yii::$app->session->setFlash('feedBackDone', 'Сообщение отправленно');
                $feedback->save();
                Email::sendFeedBackToUser($feedback);
                $model = new FeedbackForm();
                return $this->render('index', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('index', [
                    'model' => $model,
                ]);
            }
        }
    }
