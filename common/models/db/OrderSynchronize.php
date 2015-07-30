<?php

    namespace common\models\db;

    use backend\modules\api\classes\AskFM;
    use backend\modules\api\classes\Instagram;
    use backend\modules\api\classes\Twitter;
    use backend\modules\api\classes\VK;
    use Yii;
    use yii\helpers\ArrayHelper;

    /**
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

        public static function synchronizeStatuses()
        {
            $tasks = Vk::getTasks();
            $tasks = ArrayHelper::merge($tasks, Instagram::getTasks());
            $tasks = ArrayHelper::merge($tasks, Twitter::getTasks());
            $tasks = ArrayHelper::merge($tasks, AskFM::getTasks());

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
    }
