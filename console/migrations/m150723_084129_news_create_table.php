<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m150723_084129_news_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('news', [
                'id'      => Schema::TYPE_PK,
                'title'   => Schema::TYPE_STRING . ' NOT NULL',
                'dt_add'  => Schema::TYPE_INTEGER . ' NOT NULL',
                'content' => Schema::TYPE_TEXT . ' NOT NULL',
                'tags'    => Schema::TYPE_STRING . ' NOT NULL',
                'status'  => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        }

        public function down()
        {
            $this->dropTable('news');
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
