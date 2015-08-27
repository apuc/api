<?php
    /**
     * Created by PhpStorm.
     * User: admin
     * Date: 24.08.2015
     * Time: 16:48
     */

    namespace console\controllers;


    use common\models\db\OrderSynchronize;
    use common\models\db\Wrap;
    use yii\console\Controller;

    class CronController extends Controller
    {
        public function actionIndex(){
            $this->addWrap();
            $this->synchronizeStatuses();
        }

        public function addWrap()
        {
            Wrap::addWrap();
        }

        public function synchronizeStatuses()
        {
            OrderSynchronize::synchronizeStatuses();
        }
    }