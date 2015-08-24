<?php
    namespace console\controllers;

    use common\classes\VKApi;
    use common\models\db\Post;
    use common\models\db\Promotion;
    use common\models\db\Task;
    use yii\console\Controller;

    class VkHandlerController extends Controller
    {
        public function actionGo()
        {
            $groups = Promotion::findAll(['status' => Promotion::MODERATED]);

            foreach ($groups as $group) {
                $wall = VKApi::getWallPosts($group->page_id);

                if ($wall) {
                    $parsingPeriod = mktime(strftime('-1 hour', time()));
                    foreach ($wall as $post) {
                        //если пост подходит по времени
                        if ($post['date'] > $parsingPeriod) {
                            //формирум урл поста https://vk.com/feed?w=wall-57424472_71791

                            $dbPost = new Post();

                            $dbPost->post_id = $post['id'];
                            $dbPost->promotion_id = $group->page_id;
                            $dbPost->save();

                            $postUrl = 'https://vk.com/feed?w=wall' . $group->page_id . '_' . $post['id'];

                            //получаем таски

                            $tasks = Task::findAll(['promotion_id' => $group->id]);

                            foreach ($tasks as $task) {

                                $taskArr = json_decode($task->task);

                                //дописываем в урл и цену лайков
                                $taskArr['task']['url'] = $postUrl;
                                $taskArr['task']['cost'] = $task->service->minimum_likes_per_task;

                                //получаем цену таска
                                $pricePerOne = $task->service->price_per_one_task;
                                $priceAll = $pricePerOne * $taskArr['task']['members_count'];

                                //списываем деньги с пользователя к которому он относится

                                $user = $group->user;
                                if ($user->money - $priceAll >= 0) {

                                    $user->money -= $priceAll;
                                    $user->save();

                                    //если хватило то отсылаем таск
                                    $this->setTask($taskArr);
                                }
                            }
                        }
                    }
                }

                usleep(335000);
            }
        }

        public static function setTask($task)
        {
            $token = \Yii::$app->params['like4uAccessToken'];

            $query['token'] = $token;

            $query = array_merge($query, $task);

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/tasks.json');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($query));

            $result = curl_exec($curl);

            curl_close($curl);

            $resultObj = json_decode($result);
            $id = $resultObj->id ? $resultObj->id : false;

            return $id;
        }
    }