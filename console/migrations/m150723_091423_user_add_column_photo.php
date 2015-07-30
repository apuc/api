<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m150723_091423_user_add_column_photo extends Migration
    {
        public function up()
        {
            $this->addColumn('user', 'photo', Schema::TYPE_STRING);
        }

        public function down()
        {
            $this->dropColumn('user', 'photo');
        }
    }
