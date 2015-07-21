<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m150720_185122_order_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('order', [
                'id'         => Schema::TYPE_PK,
                'user_id'    => Schema::TYPE_INTEGER . ' NOT NULL',
                'service_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'date'       => Schema::TYPE_INTEGER . '(10) NOT NULL',
                'task_url'   => Schema::TYPE_STRING,
                'quantity'   => Schema::TYPE_INTEGER . ' NOT NULL',
                'status'     => Schema::TYPE_INTEGER . '(1) NOT NULL',
                'task'       => Schema::TYPE_TEXT . ' NOT NULL',
                'limits'      => Schema::TYPE_TEXT,
            ], $tableOptions);

            $this->addForeignKey('user_order_fk', 'order', 'user_id', 'user', 'id', 'RESTRICT', 'CASCADE');
            $this->addForeignKey('service_order_fk', 'order', 'service_id', 'service', 'id', 'RESTRICT', 'CASCADE');
        }

        public function down()
        {
            $this->dropForeignKey('user_order_fk', 'order');
            $this->dropForeignKey('service_order_fk', 'order');

            $this->dropTable('order');
        }
    }
