<?php

namespace c006\email\models\search;

use c006\email\models\EmailTemplates as EmailTemplatesModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EmailTemplates represents the model behind the search form about `c006\email\models\EmailTemplates`.
 */
class EmailTemplates extends EmailTemplatesModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'template_name', 'updated'], 'safe'],
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
        $query = EmailTemplatesModel::find();

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
            'id'      => $this->id,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'template_name', $this->template_name]);

        return $dataProvider;
    }
}
