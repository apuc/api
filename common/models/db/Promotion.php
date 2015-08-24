<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "promotion".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $url
 * @property integer $page_id
 * @property integer $status
 *
 * @property Post[] $posts
 * @property User $user
 * @property Task[] $tasks
 * @property RejectedCommentAuto[] $rejectedCommentsAuto
 */
class Promotion extends \yii\db\ActiveRecord
{
    const REJECTED = -2;
    const NOT_MODERATED = 0;
    const MODERATED = 1;

    public static function tableName()
    {
        return 'promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'url', 'page_id', 'status'], 'required'],
            [['user_id', 'page_id', 'status'], 'integer'],
            [['url'], 'string', 'max' => 255]
        ];
    }


    public static function getStatuses()
    {
        return [
            self::REJECTED      => 'Отклонено',
            self::NOT_MODERATED => 'На модерации',
            self::MODERATED     => 'Отмодерировано',
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'url' => 'Url',
            'page_id' => 'Page ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['promotion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['promotion_id' => 'id']);
    }

    public function getRejectedCommentAuto()
    {
        return $this->hasMany(RejectedCommentAuto::className(), ['promotion_id' => 'id']);
    }
}
