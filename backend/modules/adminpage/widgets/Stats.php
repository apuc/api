<?php
    /**
     * Created by PhpStorm.
     * User: admin
     * Date: 17.07.2015
     * Time: 11:21
     */

    namespace backend\modules\adminpage\widgets;


    use backend\modules\api\classes\VK;
    use yii\base\Widget;
    use yii\helpers\Html;

    class Stats extends Widget
    {
        public function run()
        {
            $user = VK::getUserInfo();
            return $this->render('stats/stats', [
                'like' => $user->money,
                'accountType' => $user->type,
            ]);
        }
    }