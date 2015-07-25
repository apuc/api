<?php

namespace frontend\modules\news\widgets;

use backend\modules\news\models\db\News;
use yii\helpers\Html;
use yii\base\Widget;
use yii\db\ActiveRecord;

class LastNews extends Widget
{
    /*public $news;

    public function init()
    {
        parent::init();

            $news = News::find()->orderBy('dt_add')->all();

           print_r($news->title);

    }

    public function run()
    {
        return Html::encode($this->news);
    }*/

    public $message;

    public function run()
    {
        $news = News::getDb()->cache(function () {
            return News::find()->orderBy('dt_add DESC')->limit(4)->all();
        });

        return $this->render('last_news', ['news' => $news]);
    }


}