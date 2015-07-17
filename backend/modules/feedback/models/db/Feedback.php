<?php

    namespace backend\modules\feedback\models\db;

    /**
     * This is the model class for table "feedback".
     *
     * @property integer $id
     * @property string $email
     * @property string $name
     * @property string $text
     * @property string $status
     * @property integer $created_at
     * @property integer $updated_at
     */
    class Feedback extends \common\models\db\Feedback
    {

    }