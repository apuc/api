<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $latin_name
 * @property string $name
 * @property integer $value
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latin_name', 'name', 'value'], 'required'],
            [['value'], 'integer'],
            [['latin_name', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'latin_name' => 'Latin Name',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }
}
