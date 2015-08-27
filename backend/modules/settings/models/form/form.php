<?php

    namespace backend\modules\settings\models\form;

    use common\models\db\Settings;
    use yii\base\Model;

    class Form extends Model
    {
        public $referral_percent;
        public $referral_pay_num;

        public function __construct()
        {
            foreach ($this->attributes() as $attribute) {
                $this->$attribute = Settings::findOne(['latin_name' => $attribute])->value;
            }
        }

        public function save()
        {
            foreach ($this->attributes() as $attribute) {
                $setting = Settings::findOne(['latin_name' => $attribute]);
                $setting->value = $this->$attribute;
                $setting->save();
            }
        }

        public function rules()
        {
            return [
                [['referral_percent', 'referral_pay_num'], 'required'],
                [['referral_percent', 'referral_pay_num'], 'integer'],
            ];
        }

        public function attributeLabels()
        {
            return [
                'referral_percent' => 'Проценты с пополнения',
                'referral_pay_num' => 'От первых N пополнений',
            ];
        }
    }