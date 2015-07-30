<?php

    namespace console\controllers;


    use common\models\db\User;
    use yii\console\Controller;

    class RbacController extends Controller
    {
        public function actionInit()
        {
            $authManager = \Yii::$app->authManager;

            // Create roles
            $user = $authManager->createRole('user');
            //$moderator = $authManager->createRole('moderator');
            $admin = $authManager->createRole('administrator');

            //$guest->ruleName  = 'guest';
            //$user->ruleName  = 'user';
            //$moderator->ruleName = 'moderator';
            //$admin->ruleName = 'administrator';

            // Add roles in Yii::$app->authManager
            $authManager->add($user);
            //$authManager->add($moderator);
            $authManager->add($admin);

            $role = $authManager->getRole(User::TYPE_ADMINISTRATOR);
            $authManager->assign($role, 1);
        }

    }