<?php

    namespace backend\modules\autopromotion\controllers;

    use backend\modules\autopromotion\models\form\PromotionSearch;
    use common\models\db\Promotion;
    use Yii;
    use yii\db\Exception;
    use yii\web\NotFoundHttpException;

    class OrderController extends TaskController
    {
        public function actionIndex()
        {
            $searchModel = new PromotionSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        public function actionView($id)
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }

        /**
         * @var \common\modules\statistics\models\Order $model
         *
         * @param                                       $id
         *
         * @return \yii\web\Response
         * @throws Exception
         * @throws NotFoundHttpException
         */
        public function actionApply($id)
        {
            $model = $this->findModel($id);

            $model->status = Promotion::MODERATED;
            $model->save(false);

            return $this->redirect(['index']);
        }
    }
