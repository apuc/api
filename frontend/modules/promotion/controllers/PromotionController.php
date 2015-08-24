<?php

    namespace frontend\modules\promotion\controllers;

    use common\models\db\Promotion;
    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;
    use yii\web\Controller;

    class PromotionController extends Controller
    {
        public function actionViewAll()
        {
            $userId = \Yii::$app->user->getId();

            $provider = new ActiveDataProvider([
                'query'      => Promotion::find()->where(['user_id' => $userId]),
                'sort'       => ['defaultOrder' => ['id' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => 20,
                ]
            ]);

            return $this->render('index', ['provider' => $provider]);
        }

        /**
         * @var $formObj Model
         * @param $type
         * @return string
         */
        public function actionViewPromotion($type)
        {
            $namespace = 'frontend\\modules\\promotion\\models\\forms\\';
            $formModel = $namespace . $type;

            $formObj = new $formModel;

            if ($formObj->load(\Yii::$app->request->post()))
            {
                if ($formObj->save()) {
                    Yii::$app->session->setFlash('message', [
                            'type'    => 'success',
                            'message' => 'Задание отправлено на модерацию',
                        ]
                    );
                }else
                    Yii::$app->session->setFlash('message', [
                            'type'    => 'danger',
                            'message' => 'Ошибка. Попробуйте ввести данные повторно.',
                        ]
                    );
            }

            return $this->render($type, ['model' => new $formModel]);
        }
    }

