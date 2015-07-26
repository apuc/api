<?php

    namespace frontend\modules\news\widgets;

    use backend\modules\news\models\db\News;
    use yii\base\Widget;

    class LastNews extends Widget
    {
        public $message;

        public function run()
        {
            $news = News::getDb()->cache(function () {
                return News::find()->orderBy('dt_add DESC')->limit(4)->all();
            });

            return $this->render('last_news', ['news' => $news]);
        }
    }