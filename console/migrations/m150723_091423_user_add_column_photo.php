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
