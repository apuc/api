<?php

use yii\db\Schema;
use yii\db\Migration;

class m150717_072225_user_add_column extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'user_type', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('user', 'user_type');
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
