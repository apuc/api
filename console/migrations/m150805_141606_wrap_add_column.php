<?php

use yii\db\Schema;
use yii\db\Migration;

class m150805_141606_wrap_add_column extends Migration
{
    public function up()
    {
        $this->addColumn('wrap', 'date', Schema::TYPE_INTEGER . ' DEFAULT 1438719600');
    }

    public function down()
    {
        $this->dropColumn('wrap', 'date');
    }
}
