<?php
    namespace common\modules\statistics\controllers;


    use common\models\db\Wrap;
    use common\modules\statistics\models\Order;
    use common\modules\statistics\widgets\StatisticsMenu;
    use yii\web\Controller;

    class AjaxController extends Controller
    {
        public function actionGet()
        {
            //костыль
            $done = Order::find(['status' => Order::DONE])->count();
            $like = StatisticsMenu::getCount(1);
            $subscriber = StatisticsMenu::getCount(3);
            $repost = StatisticsMenu::getCount(4);

            $wrap = Wrap::getStat();

            $data['stat_done_vk'] = $done + $wrap->done_wrap_vk;
            $data['stat_like_vk'] = $like + $wrap->like_wrap_vk;
            $data['stat_repost_vk'] = $repost + $wrap->repost_wrap_vk;
            $data['stat_subscriber_vk'] = $subscriber + $wrap->subscriber_wrap_vk;

            echo json_encode($data);
        }
    }