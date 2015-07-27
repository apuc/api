<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 23.07.2015
 * Time: 16:12
 */

namespace frontend\modules\feedback\controllers;
use common\classes\Email;
use common\models\db\Feedback;
use Yii;

use common\models\FeedbackForm;
use yii\base\Controller;

class FeedbackController extends Controller
{

    public function actionIndex()
    {
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