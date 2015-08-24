<?php

use yii\db\Schema;
use yii\db\Migration;

class m150817_133556_task_create_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('task', [
            'id'           => Schema::TYPE_PK,
            'service_id'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'promotion_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'task'          => Schema::TYPE_TEXT. ' NOT NULL',

        ], $tableOptions);

        $this->addForeignKey('service_task_fk', 'task', 'service_id', 'service', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('promotion_task_fk', 'task', 'promotion_id', 'promotion', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('service_task_fk', 'task');
        $this->dropForeignKey('promotion_task_fk', 'task');

        $this->dropTable('task');
    }
}
