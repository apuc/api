<?php

use yii\db\Schema;
use yii\db\Migration;

class m150801_113853_news_add_column_short_text extends Migration
{
    public function up()
    {
        $this->addColumn('news', 'short_text', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('news', 'short_text');

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
