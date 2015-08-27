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
                ],
            ]);

            return $this->render('index', ['provider' => $provider]);
        }

        /**
         * @var   $formObj Model
         *
         * @param $type
         *
         * @return string
         */
        public function actionViewPromotion($type, $id = null)
        {
            $namespace = 'frontend\\modules\\promotion\\models\\forms\\';
            $formModel = $namespace . $type;

            $formObj = new $formModel($id);
            $newRecord = $formObj->isNewRecord;

            if ($formObj->load(\Yii::$app->request->post())) {
                if ($formObj->save()) {
                    if ($newRecord)
                        Yii::$app->session->setFlash('message', [
                                'type'    => 'success',
                                'message' => 'Задание отправлено на модерацию',
                            ]
                        );
                    else
                        Yii::$app->session->setFlash('message', [
                                'type'    => 'success',
                                'message' => 'Задание отправлено на повторную модерацию',
                            ]
                        );

                    return $this->redirect(Yii::$app->urlManager->createUrl(['promotion/promotion/view-promotion','type'=>'vk']));
                } else
                    Yii::$app->session->setFlash('message', [
                            'type'    => 'danger',
                            'message' => 'Ошибка. Попробуйте ввести данные повторно.',
                        ]
                    );
            }

            return $this->render(strtolower($type), ['model' => new $formModel($id)]);
        }

        public function actionStart($id)
        {
            $promotion = Promotion::findOne(['id' => $id]);
            if ($promotion->status == Promotion::STOPPED) {
                $promotion->status = Promotion::MODERATED;
                $promotion->save();

                Yii::$app->session->setFlash('message', [
                        'type'    => 'success',
                        'message' => 'Выполнение задания возобновлено.',
                    ]
                );
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        public function actionStop($id)
        {
            $promotion = Promotion::findOne(['id' => $id]);
            if ($promotion->status == Promotion::MODERATED) {
                $promotion->status = Promotion::STOPPED;
                $promotion->save();

                Yii::$app->session->setFlash('message', [
                        'type'    => 'success',
                        'message' => 'Выполнение задания остановлено.',
                    ]
                );
            }

            return $this->redirect(Yii::$app->request->referrer);
        }
    }

