<?php
    namespace frontend\modules\task\models\db;

    use common\classes\Debag;

    class Order extends \common\models\db\Order
    {
        public function __construct1($kind)
        {
            $this->kind = $this->typeToKind($kind);
            $this->service_id = Service::findOne(['model_name' => $kind])->id;
            $this->user_id = \Yii::$app->user->getId();
            $this->cost = $this->service->minimum_likes_per_task;
            $this->date = time();

            if ($this->isNewRecord)
                $this->status = self::NOT_MODERATED;
        }

        public function __construct(){
            $a = func_get_args();
            $i = func_num_args();
            if (method_exists($this,$f='__construct'.$i)) {
                call_user_func_array(array($this,$f),$a);
            }
        }
    }