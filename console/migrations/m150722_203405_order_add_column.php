<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m150722_203405_order_add_column extends Migration
    {
        public function up()
        {
            $this->addColumn('order', 'foreign_id', Schema::TYPE_INTEGER);
            $this->createIndex('order_foreign_id_index', 'order', 'foreign_id', true);
        }

        public function down()
        {
            $this->dropIndex('order_foreign_id_index', 'order');
            $this->dropColumn('order', 'foreign_id');
        }
    }
