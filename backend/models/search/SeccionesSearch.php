<?php

namespace backend\models\search;

use common\models\Roles;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SeccionesModulos;

/**
 * SeccionesSearch represents the model behind the search form about `common\models\SeccionesModulos`.
 */
class SeccionesSearch extends SeccionesModulos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['secPregunta', 'secNumeroPregunta', 'secTipoRespuesta', 'secEstado', 'modCodigo', 'usuCodigo'], 'safe']
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
        $query = SeccionesModulos::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'secPregunta', $this->secPregunta])
            ->andFilterWhere(['like', 'secNumeroPregunta', $this->secNumeroPregunta])
            ->andFilterWhere(['like', 'secTipoRespuesta', $this->secTipoRespuesta])
            ->andFilterWhere(['like', 'secEstado', $this->secEstado])
            ->andFilterWhere(['like', 'modCodigo', $this->modCodigo])
            ->andFilterWhere(['like', 'usuCodigo', $this->usuCodigo])
            ->orderBy('secNumeroPregunta');

        return $dataProvider;
    }
}
