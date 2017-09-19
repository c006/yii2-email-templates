<?php

namespace c006\email\models\search;

use c006\email\models\Files as EmailTemplateFilesModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Files represents the model behind the search form about `c006\email\models\Files`.
 */
class Files extends EmailTemplateFilesModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'template_id'], 'integer'],
            [['name', 'file'], 'safe'],
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
        $query = EmailTemplateFilesModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith('emailTemplates');

        $query->andFilterWhere([
            'id'          => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'file', $this->file])
            ->orFilterWhere(['like', 'email_templates.id', $this->template_id])
            ->orFilterWhere(['like', 'email_templates.name', $this->template_id]);

        return $dataProvider;
    }
}
