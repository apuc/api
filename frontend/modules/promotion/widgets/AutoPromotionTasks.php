<?php
    namespace frontend\modules\promotion\widgets;


    use common\models\db\OrderSynchronize;
    use common\models\db\Promotion;
    use frontend\modules\task\models\db\Order;
    use frontend\modules\task\models\db\Service;
    use yii\base\Widget;

    class AutoPromotionTasks extends Widget
    {
        public $type;

        public function run()
        {
            $userId = \Yii::$app->user->getId();

            $promotions = Promotion::find()
                ->where(['user_id' => $userId])
                ->orderBy('id DESC')
                ->limit(4)
                ->all();


            if (count($promotions))
                return $this->render('lastTasks', ['promotions' => $promotions]);
            else
                echo '';
        }
    }