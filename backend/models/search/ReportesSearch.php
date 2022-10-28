<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reportes;

/**
 * ReportesSearch represents the model behind the search form about `common\models\Menus`.
 */
class ReportesSearch extends Reportes
{
    /**
     * @inheritdoc
     */
    public $start = '';
    public $end = '';
    public function rules()
    {
        return [
            [['numeroAciertos', 'tiempoTrascurrido', 'numeroErrores', 'fechaEjecucion', 'usuCodigo', 'insCodigo', 'usuEncargado'], 'safe']
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
        $query = Reportes::find();

        if ($this->start !== '' && $this->end !== '') {

            $query = $query->andFilterWhere(['>=', 'fechaEjecucion', $this->start])
                ->andFilterWhere(['<=', 'fechaEjecucion', $this->end])
                ->orderBy('fechaEjecucion DESC');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if ($this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->andFilterWhere(['LIKE', 'numeroAciertos', $this->numeroAciertos])
                ->andFilterWhere(['LIKE', 'fechaEjecucion', $this->fechaEjecucion])
                ->andFilterWhere(['LIKE', 'tiempoTrascurrido', $this->tiempoTrascurrido])
                ->andFilterWhere(['LIKE', 'numeroErrores', $this->numeroErrores])
                ->andFilterWhere(['LIKE', 'usuCodigo', $this->usuCodigo])
                ->andFilterWhere(['LIKE', 'insCodigo', $this->insCodigo])
                ->andFilterWhere(['LIKE', 'usuEncargado', $this->usuEncargado]);
        }


        return $dataProvider;
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchUsuario($params)
    {
        $query = Reportes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if ($this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->andFilterWhere(['LIKE', 'numeroAciertos', $this->numeroAciertos])
                ->andFilterWhere(['LIKE', 'fechaEjecucion', $this->fechaEjecucion])
                ->andFilterWhere(['LIKE', 'tiempoTrascurrido', $this->tiempoTrascurrido])
                ->andFilterWhere(['LIKE', 'numeroErrores', $this->numeroErrores])
                ->andFilterWhere(['LIKE', 'usuCodigo', $this->usuCodigo])
                ->andFilterWhere(['LIKE', 'insCodigo', $this->insCodigo])
                ->andFilterWhere(['LIKE', 'usuEncargado', $this->usuEncargado]);
        }


        return $dataProvider;
    }
}
