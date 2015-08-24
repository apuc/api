<?php

    use yii\db\Migration;
    use yii\db\Schema;

    class m150817_091337_promotion_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('promotion', [
                'id'      => Schema::TYPE_PK,
                'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'url'     => Schema::TYPE_STRING . ' NOT NULL',
                'page_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'status' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);

            $this->addForeignKey('user_promotion_fk', 'promotion', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        }

        public function down()
        {
            $this->dropForeignKey('user_promotion_fk', 'promotion');

            $this->dropTable('promotion');
        }
    }
