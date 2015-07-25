<?php

    namespace common\models\db;

    use backend\modules\api\classes\VK;
    use Yii;

    /**
     * This is the model class for table "order_synchronize".
     *
     * @property integer $id
     * @property integer $time
     */
    class OrderSynchronize extends \yii\db\ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'order_synchronize';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['time'], 'required'],
                [['time'], 'integer']
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'   => 'ID',
                'time' => 'Time',
            ];
        }

        public function updateTime()
        {
            $this->time = time();
            return $this->save();
        }

        /**
         * Проверяем, прошло ли $seconds секунд с поседнего сохранения
         *
         * @param $seconds
         * @return bool
         */
        public function timeLeft($seconds)
        {
            $currentTime = time();
            if ($seconds > ($currentTime - $this->time))
                return true;

            return false;
        }

        /**
         * @return OrderSynchronize
         */
        public static function getObj()
        {
            return self::findOne(['id' => 1]);
        }

        public static function synchronizeStatuses(){
            $tasks = Vk::getTasks();

            foreach ($tasks as $task) {
                if ($task->finished) {
                    $order = Order::findOne(['foreign_id' => $task->id]);
                    if (isset($order->status)) {
                        if ($order->status != Order::DONE) {
                            $order->status = Order::DONE;
                            $order->save();
                        }
                    }
                }
            }
        }
    }
