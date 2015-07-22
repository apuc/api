<?php
    namespace frontend\modules\task\models\db;

    use common\classes\Debag;

    class Order extends \common\models\db\Order
    {
        public function __construct($kind)
        {
            $this->kind = $this->typeToKind($kind);
            $this->service_id = Service::findOne(['model_name' => $kind])->id;
            $this->user_id = \Yii::$app->user->getId();
            $this->cost = $this->service->minimum_likes_per_task;
            $this->date = time();

            if ($this->isNewRecord)
                $this->status = self::NOT_MODERATED;
        }
    }