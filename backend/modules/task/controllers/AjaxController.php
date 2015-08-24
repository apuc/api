<?php

    namespace backend\modules\task\controllers;

    use backend\modules\task\models\db\Order;
    use common\models\db\RejectedComment;
    use Yii;

    class AjaxController extends TaskController
    {
        public function actionRejected($id)
        {
            $model = $this->findModel($id);

            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                $user = $model->user;
                $user->addMoney($model->sum);
                $user->save();

                $model->status = Order::REJECTED;
                $model->save();

                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
            }

            $text = Yii::$app->request->post('text', false);
            if ($text === false)
                echo 1;
            else {
                $rejectedComment = new RejectedComment();
                $rejectedComment->text = $text;
                $rejectedComment->order_id = $model->id;
                $rejectedComment->date = time();

                if ($rejectedComment->save())
                    echo 1;
                else
                    echo 0;
            }
        }
    }