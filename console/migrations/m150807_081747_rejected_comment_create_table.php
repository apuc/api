<?php

    use yii\db\Migration;
    use yii\db\Schema;

    class m150807_081747_rejected_comment_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('rejected_comment', [
                'id'       => Schema::TYPE_PK,
                'order_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'text'     => Schema::TYPE_TEXT,
                'date'     => Schema::TYPE_INTEGER . '(10)',
            ], $tableOptions);

            $this->addForeignKey('order_rejected_comment_fk', 'rejected_comment', 'order_id', 'order', 'id', 'CASCADE', 'CASCADE');
        }

        public function down()
        {
            $this->dropForeignKey('order_rejected_comment_fk', 'rejected_comment');

            $this->dropTable('rejected_comment');
        }
    }
