<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m150722_144529_user_update_column extends Migration
    {
        public function up()
        {
            $this->alterColumn('user', 'money', Schema::TYPE_DOUBLE . ' NOT NULL DEFAULT 0');
        }

        public function down()
        {
            $this->alterColumn('user', 'money', Schema::TYPE_BOOLEAN);
        }
    }
