<?php

    use yii\db\Migration;
    use yii\db\Schema;

    class m150718_105504_create_user_table extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('user', [
                'id'         => Schema::TYPE_PK,
                'money'      => Schema::TYPE_DOUBLE . ' NOT NULL DEFAULT 0',
                'cash_id'    => Schema::TYPE_STRING,
                'email'      => Schema::TYPE_STRING . ' NOT NULL',
                'password'   => Schema::TYPE_STRING . ' NOT NULL',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'salt'       => Schema::TYPE_STRING . ' NOT NULL',
                'status'     => Schema::TYPE_INTEGER,
                'username'   => Schema::TYPE_STRING . ' NOT NULL',
                'auth_key'   => Schema::TYPE_STRING,
            ], $tableOptions);

            $salt = sha1(time() . '76s3d');

            $password = hash_hmac('sha512', 'admin', $salt);

            $this->insert('user', [
                'money'      => 5000,
                'cash_id'    => md5(1),
                'email'      => 'admin@smm-promoter.ru',
                'password'   => $password,
                'created_at' => time(),
                'updated_at' => time(),
                'salt'       => $salt,
                'status'     => 1,
                'username'   => 'admin',
            ]);
        }

        public function down()
        {
            $this->dropTable('user');
        }
    }
