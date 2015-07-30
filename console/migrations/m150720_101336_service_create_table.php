<?php

    use yii\db\Migration;
    use yii\db\Schema;

    class m150720_101336_service_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('service', [
                'id'                     => Schema::TYPE_PK,
                'model_name'             => Schema::TYPE_STRING . ' NOT NULL',
                'name'                   => Schema::TYPE_STRING . ' NOT NULL',
                'minimum_all_likes'      => Schema::TYPE_INTEGER . ' NOT NULL',
                //необходимый минимум лайков для задания (нельзя меньше реального)
                'minimum_tasks'          => Schema::TYPE_INTEGER . ' NOT NULL',
                //минимальное кол-во выполнений задания (к примеру 10 репостов или 10 лайков)
                'minimum_likes_per_task' => Schema::TYPE_INTEGER . ' NOT NULL',
                //оплата за задание(1 коммент..), лайков на like4u (нельзя ниже реальной)
                'price_per_one_task'     => Schema::TYPE_DOUBLE . ' NOT NULL',//Реальных денег за 1 выпонение
                'minimum_price_per_task' => Schema::TYPE_DOUBLE . ' NOT NULL',//Реальных денег за все задание
                'network'                => Schema::TYPE_INTEGER . ' NOT NULL',//Реальных денег за все задание

            ], $tableOptions);

            // VK
            $this->insert('service', [
                'model_name'             => 'LikeVK',
                'name'                   => 'Лайки',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => '1',
            ]);
            $this->insert('service', [
                'model_name'             => 'FriendVK',
                'name'                   => 'Друзья',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => '1',
            ]);
            $this->insert('service', [
                'model_name'             => 'SubscriberVK',
                'name'                   => 'Подписчики',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => '1',
            ]);
            $this->insert('service', [
                'model_name'             => 'RepostVK',
                'name'                   => 'Репосты',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => '1',
            ]);
            $this->insert('service', [
                'model_name'             => 'CommentVK',
                'name'                   => 'Комментарии',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => '1',
            ]);
            $this->insert('service', [
                'model_name'             => 'InterviewVK',
                'name'                   => 'Опрос',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => '1',
            ]);

            // Instagram
            $this->insert('service', [
                'model_name'             => 'LikeInstagram',
                'name'                   => 'Лайки в инстаграм',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => 2,
            ]);
            $this->insert('service', [
                'model_name'             => 'SubscriberInstagram',
                'name'                   => 'Подписчики в инстаграмм',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => 2,
            ]);

            // Twitter
            $this->insert('service', [
                'model_name'             => 'RetwitTwitter',
                'name'                   => 'Ретвиты в Твиттере',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => 3,
            ]);
            $this->insert('service', [
                'model_name'             => 'SubscriberTwitter',
                'name'                   => 'Подписчики в Твиттере',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => 3,
            ]);
            $this->insert('service', [
                'model_name'             => 'FavoriteTwitter',
                'name'                   => 'Избранное в Твиттере',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => 3,
            ]);

            // Ask
            $this->insert('service', [
                'model_name'             => 'LikeAskFM',
                'name'                   => 'Лайки в АскФМ',
                'minimum_all_likes'      => 0,
                'minimum_tasks'          => 0,
                'minimum_likes_per_task' => 0,
                'price_per_one_task'     => 100,
                'minimum_price_per_task' => 0,
                'network'                => 4,
            ]);
        }

        public function down()
        {
            $this->dropTable('service');
        }

        /*
        // Use safeUp/safeDown to run migration code within a transaction
        public function safeUp()
        {
        }

        public function safeDown()
        {
        }
        */
    }
