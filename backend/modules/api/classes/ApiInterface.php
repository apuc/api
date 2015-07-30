<?php
    namespace backend\modules\api\classes;

    use common\models\db\Order;

    interface ApiInterface
    {
        static function getUserInfo();

        /**
         * @param Order $model
         * @return mixed
         */
        static function setTask($model);
        static function getTasks();

        /**
         * @param integer $id
         * @return mixed
         */
        static function getTask($id);

        /**
         * @param integer $id
         * @return mixed
         */
        static function deleteTask($id);
    }