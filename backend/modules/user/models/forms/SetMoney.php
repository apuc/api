<?php
    /**
     * Created by PhpStorm.
     * User: admin
     * Date: 05.08.2015
     * Time: 18:57
     */

    namespace backend\modules\user\models\forms;


    use backend\modules\user\models\User;
    use yii\db\ActiveRecord;

    /**
     * Class SetMoney
     *
     * @property integer $id
     * @property double $money
     *
     * @package backend\modules\user\models\forms
     *
     */
    class SetMoney extends ActiveRecord
    {
        public $id;
        public $money;

        public function rules()
        {
            return [
                ['id', 'integer'],
                ['money', 'number'],
            ];
        }

        public function attributeLabels()
        {
            return [
                'id'    => 'Пользователь',
                'money' => 'Рублей',
            ];
        }

        public function apply()
        {
            $user = User::findOne($this->id);

            $user->money = $this->money;
            $user->save();

            return true;
        }
    }