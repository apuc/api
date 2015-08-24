<?php

    use yii\db\Migration;
    use yii\db\Schema;

    class m150817_120753_post_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('post', [
                'id'           => Schema::TYPE_PK,
                'promotion_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'url'          => Schema::TYPE_STRING . ' NOT NULL',
                'post_id'      => Schema::TYPE_INTEGER,

            ], $tableOptions);

            $this->addForeignKey('promotion_post_fk', 'post', 'promotion_id', 'promotion', 'id', 'CASCADE', 'CASCADE');
        }

        public function down()
        {
            $this->dropForeignKey('promotion_post_fk', 'post');

            $this->dropTable('post');
        }
    }
