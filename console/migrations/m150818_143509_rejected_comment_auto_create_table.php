<?php

    use yii\db\Migration;
    use yii\db\Schema;

    class m150818_143509_rejected_comment_auto_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('rejected_comment_auto', [
                'id'           => Schema::TYPE_PK,
                'promotion_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'text'         => Schema::TYPE_TEXT,
                'date'         => Schema::TYPE_INTEGER . '(10)',
            ], $tableOptions);

            $this->addForeignKey('promotion_rejected_comment_auto_fk', 'rejected_comment_auto', 'promotion_id', 'promotion', 'id', 'CASCADE', 'CASCADE');
        }

        public function down()
        {
            $this->dropForeignKey('promotion_rejected_comment_auto_fk', 'rejected_comment_auto');

            $this->dropTable('rejected_comment_auto');
        }
    }
