<?php

    namespace frontend\modules\profile\classes;

    use yii\db\ActiveRecord;

    class UploadPhoto extends ActiveRecord
    {
        /**
         * @var UploadedFile file attribute
         */
        public $file;

        /**
         * @return array the validation rules.
         */
        public function rules()
        {
            return [
                [['file'], 'file'],
            ];
        }
    }