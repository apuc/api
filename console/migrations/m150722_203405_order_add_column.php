<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m150722_203405_order_add_column extends Migration
    {
        public function up()
        {
            $this->addColumn('order', 'foreign_id', Schema::TYPE_INTEGER);
        }

        public function down()
        {
            $this->dropColumn('order', 'foreign_id');
        }
    }
