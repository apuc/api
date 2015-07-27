<?php


namespace frontend\modules\news\controllers;

use frontend\modules\news\models\News;
use yii\data\Pagination;
use yii\web\Controller;

class NewsController extends Controller{
    public function actionAllNews(){
        $news = News::find()->orderBy('dt_add DESC');
        $countQuery = clone $news;
        $pages = new Pagination(['totalCount' =>  $countQuery->count(), 'pageSize' => 2]);
        $news = $news->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('all', [
            'news' => $news,
            'pages' => $pages,
        ]);

    }
} 