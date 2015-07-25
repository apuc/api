<?php
    namespace backend\modules\adminpage\widgets;

    use backend\modules\api\classes\VK;
    use yii\base\Widget;

    class Stats extends Widget
    {
        public function run()
        {
            $cache = \Yii::$app->cache;

            $user = null;
            if ($cache->exists('user_cache')) {
                $user = $cache->get('user_cache');
            } else {
                $user = VK::getUserInfo();

                $cache->set('user_cache', $user, 300);
            }

            return $this->render('stats/stats', [
                'like'        => $user->money,
                'accountType' => $user->type,
            ]);
        }
    }