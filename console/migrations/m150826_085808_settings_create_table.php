<?php

    use yii\db\Migration;
    use yii\db\Schema;

    class m150826_085808_settings_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('settings', [
                'id'         => Schema::TYPE_PK,
                'latin_name' => Schema::TYPE_STRING . ' NOT NULL',
                'name'       => Schema::TYPE_STRING . ' NOT NULL',
                'value'      => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);

            $this->insert('settings',[
                'latin_name' => 'referral_percent',
                'name'       => 'Проценты с пополнения',
                'value'      => 0,
            ]);
            $this->insert('settings',[
                'latin_name' => 'referral_pay_num',
                'name'       => 'От первых N пополнений',
                'value'      => 0,
            ]);
    }

        public function down()
        {
            $this->dropTable('settings');
        }
    }
