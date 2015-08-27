<?php

    use yii\db\Migration;
    use yii\db\Schema;

    class m150826_105106_referral_money_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('referral_money', [
                'id'             => Schema::TYPE_PK,
                'user_id'        => Schema::TYPE_INTEGER . ' NOT NULL',
                'referral_percent' => Schema::TYPE_INTEGER . ' NOT NULL',
                'payment_sum'    => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);

            $this->addForeignKey('user_referral_money_fk', 'referral_money', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        }

        public function down()
        {
            $this->dropForeignKey('user_referral_money_fk', 'referral_money');

            $this->dropTable('referral_money');
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
