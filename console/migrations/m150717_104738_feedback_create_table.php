<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m150717_104738_feedback_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('feedback', [
                'id'         => Schema::TYPE_PK,
                'email'      => Schema::TYPE_STRING . ' NOT NULL',
                'name'       => Schema::TYPE_STRING . '(25) NOT NULL',
                'text'       => Schema::TYPE_TEXT . ' NOT NULL',
                'status'     => Schema::TYPE_STRING . '(1) NOT NULL',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        }

        public function down()
        {
            $this->dropTable('feedback');
        }
    }
