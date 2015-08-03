<?php

    use yii\db\Migration;
    use yii\db\Schema;

    class m150803_092829_wrap_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('wrap', [
                'id'                 => Schema::TYPE_PK,
                'done_wrap_vk'       => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'like_wrap_vk'       => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'repost_wrap_vk'     => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'subscriber_wrap_vk' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            ], $tableOptions);

            $this->insert('wrap', [
                'done_wrap_vk'       => 0,
                'like_wrap_vk'       => 0,
                'repost_wrap_vk'     => 0,
                'subscriber_wrap_vk' => 0,
            ]);
        }

        public function down()
        {
            $this->dropTable('wrap');
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
