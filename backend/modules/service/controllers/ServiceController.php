<?php

namespace backend\modules\service\controllers;

use backend\modules\service\models\db\Comment;
use backend\modules\service\models\db\Friend;
use backend\modules\service\models\db\Interview;
use backend\modules\service\models\db\Like;
use backend\modules\service\models\db\Repost;
use backend\modules\service\models\db\Service;
use backend\modules\service\models\db\Subscriber;
use Yii;
use backend\modules\service\models\form\ServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ServiceController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($type)
    {
        return $this->render('view', [
            'model' => $this->findModel($type),
        ]);
    }

//    public function actionCreate()
//    {
//        $model = new Service();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

    public function actionUpdate($type)
    {
        $model = $this->findModel($type);
        $model->scenario = $type;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'type' => $model->model_name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * @param $name
     * @return Service
     * @throws NotFoundHttpException
     */
    protected function findModel($name)
    {
        if (($model = Service::findOne(['model_name' => $name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
