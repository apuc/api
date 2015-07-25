<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m150724_125510_payment_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('payment', [
                'id'      => Schema::TYPE_PK,
                'cash_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'money'   => Schema::TYPE_DOUBLE,
            ], $tableOptions);

            $this->addForeignKey('user_cash_id_fk', 'payment', 'cash_id', 'user', 'id');
        }

        public function down()
        {
            $this->dropForeignKey('user_cash_id_fk', 'payment');

            $this->dropTable('payment');
        }
    }
