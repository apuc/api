<?php
    /**
     * Created by PhpStorm.
     * User: Кирилл
     * Date: 23.07.2015
     * Time: 10:28
     */

    namespace common\models;

    use yii\base\Model;
    use yii\web\UploadedFile;

    class UploadPhoto extends Model
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