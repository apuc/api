<?php

    namespace backend\modules\autopromotion\controllers;

    use common\models\db\Promotion;
    use common\models\db\RejectedCommentAuto;
    use Yii;

    class AjaxController extends TaskController
    {
        /**
         * @var Promotion $model
         *
         * @param integer $id
         *
         * @throws \yii\web\NotFoundHttpException
         */
        public function actionRejected($id)
        {
            $model = $this->findModel($id);

            $model->status = Promotion::REJECTED;
            $model->save();

            $text = Yii::$app->request->post('text', false);
            if ($text === false)
                echo 1;
            else {
                $rejectedComment = new RejectedCommentAuto();
                $rejectedComment->text = $text;
                $rejectedComment->promotion_id = $model->id;
                $rejectedComment->date = time();

                if ($rejectedComment->save())
                    echo 1;
                else
                    echo 0;
            }
        }
    }