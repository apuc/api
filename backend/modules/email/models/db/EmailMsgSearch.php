<?php

namespace backend\modules\email\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\email\models\db\EmailMsg;

/**
 * EmailMsgSearch represents the model behind the search form about `backend\modules\email\models\db\EmailMsg`.
 */
class EmailMsgSearch extends EmailMsg
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'key', 'text'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EmailMsg::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
