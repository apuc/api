<?php

    namespace frontend\modules\profile\classes;

    use yii\db\ActiveRecord;
    use yii\web\UploadedFile;

    class UploadPhoto extends ActiveRecord
    {
        /**
         * @var UploadedFile $file
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