<?php

    use yii\db\Migration;
    use yii\db\Schema;

    class m150720_185122_order_create_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('order', [
                'id'            => Schema::TYPE_PK,
                'user_id'       => Schema::TYPE_INTEGER . ' NOT NULL',
                'service_id'    => Schema::TYPE_INTEGER . ' NOT NULL',
                'date'          => Schema::TYPE_INTEGER . '(10) NOT NULL',
                'status'        => Schema::TYPE_INTEGER . '(1) NOT NULL',

                'kind'          => Schema::TYPE_INTEGER . '(1) NOT NULL',
                'title'         => Schema::TYPE_STRING . '(250) NOT NULL',
                'url'           => Schema::TYPE_STRING . '(255) NOT NULL',
                'members_count' => Schema::TYPE_INTEGER . ' NOT NULL',
                'cost'          => Schema::TYPE_INTEGER . ' NOT NULL',
                'tag_list'      => Schema::TYPE_STRING . '(250)',
                'sex'           => Schema::TYPE_INTEGER,
                'age_min'       => Schema::TYPE_INTEGER,
                'age_max'       => Schema::TYPE_INTEGER,
                'friends_count' => Schema::TYPE_INTEGER,
                'country'       => Schema::TYPE_INTEGER,
                'city_text'     => Schema::TYPE_STRING,
                'city'          => Schema::TYPE_INTEGER,
                'minute_1'      => Schema::TYPE_INTEGER,
                'minutes_5'     => Schema::TYPE_INTEGER,
                'hour_1'        => Schema::TYPE_INTEGER,
                'hours_4'       => Schema::TYPE_INTEGER,
                'day_1'         => Schema::TYPE_INTEGER,
                'sum'           => Schema::TYPE_DOUBLE,
                'min_followers' => Schema::TYPE_INTEGER,
                'min_media'     => Schema::TYPE_INTEGER,
                'has_avatar'    => Schema::TYPE_BOOLEAN,
                'foreign_id'    => Schema::TYPE_INTEGER,
            ], $tableOptions);

            $this->createIndex('order_foreign_id_index', 'order', 'foreign_id', false);

            $this->addForeignKey('user_order_fk', 'order', 'user_id', 'user', 'id', 'RESTRICT', 'CASCADE');
            $this->addForeignKey('service_order_fk', 'order', 'service_id', 'service', 'id', 'RESTRICT', 'CASCADE');
        }

        public function down()
        {
            $this->dropIndex('order_foreign_id_index', 'order');

            $this->dropForeignKey('user_order_fk', 'order');
            $this->dropForeignKey('service_order_fk', 'order');

            $this->dropTable('order');
        }
    }
