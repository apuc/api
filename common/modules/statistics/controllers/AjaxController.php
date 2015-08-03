<?php
    namespace common\modules\statistics\controllers;


    use common\models\db\Wrap;
    use yii\web\Controller;

    class AjaxController extends Controller
    {
        public function actionGet()
        {
            $wrap = Wrap::findOne(1);

            $data['stat_done_vk'] = $wrap->done_wrap_vk;
            $data['stat_like_vk'] = $wrap->like_wrap_vk;
            $data['stat_repost_vk'] = $wrap->repost_wrap_vk;
            $data['stat_subscriber_vk'] = $wrap->subscriber_wrap_vk;

            echo json_encode($data);
        }
    }