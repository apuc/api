<?php

use yii\db\Schema;
use yii\db\Migration;

class m150826_080549_user_add_column extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'my_referral_link', Schema::TYPE_STRING . ' NOT NULL');
        $this->addColumn('user', 'parent_referral_link', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('user', 'my_referral_link');
        $this->dropColumn('user', 'parent_referral_link');
    }
}
