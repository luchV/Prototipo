<?php

namespace backend\models\search;

use common\models\Roles;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Modulos;

/**
 * ConfiguracionSearch represents the model behind the search form about `common\models\Modulos`.
 */
class ModulosSearch extends Modulos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modNombre', 'modUrl', 'modIcono', 'modOrden', 'modSeccion'], 'safe']
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
        $query = Modulos::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'modNombre', $this->modNombre])
            ->andFilterWhere(['like', 'modUrl', $this->modUrl])
            ->andFilterWhere(['like', 'modIcono', $this->modIcono])
            ->andFilterWhere(['like', 'modOrden', $this->modOrden])
            ->andFilterWhere(['like', 'modSeccion', $this->modSeccion])
            ->orderBy('modOrden');

        return $dataProvider;
    }
}
