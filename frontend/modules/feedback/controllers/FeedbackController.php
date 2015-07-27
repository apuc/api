<?php
    namespace frontend\modules\feedback\controllers;

    use common\classes\Email;
    use common\models\db\Feedback;
    use frontend\models\forms\FeedbackForm;
    use Yii;
    use yii\base\Controller;

    class FeedbackController extends Controller
    {
<<<<<<< HEAD
        if(empty(Yii::$app->user->identity)){
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
        }
        else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }

    }
} 
=======

        public function actionIndex()
        {
            $model = new FeedbackForm();
            $feedback = new Feedback();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $feedback->status = 0;
                $feedback->created_at = time();
                $feedback->updated_at = time();
                $feedback->name = $model->name;
                $feedback->email = $model->email;
                $feedback->text = $model->text;
                $feedback->save();
                Email::sendFeedBackToUser($feedback);
                return Yii::$app->response->redirect(['']);
            } else {
                return $this->render('index', [
                    'model' => $model,
                ]);
            }
        }
    }
>>>>>>> 484791ff95f4ca170905dd47ff295e27417a6e8e
