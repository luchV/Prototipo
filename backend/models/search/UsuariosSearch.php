<?php

namespace backend\models\search;

use common\models\Roles;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UsuariosSearch represents the model behind the search form about `common\models\Usuarios`.
 */
class UsuariosSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuCodigo', 'nombre1', 'apellido1', 'correo', 'usuEncargado', 'insCodigo', 'estado', 'rolCodigo'], 'safe']
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
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'usuCodigo', $this->usuCodigo])
            ->andFilterWhere(['like', 'nombre1', $this->nombre1])
            ->andFilterWhere(['like', 'apellido1', $this->apellido1])
            ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'insCodigo', $this->insCodigo])
            ->andFilterWhere(['like', 'usuEncargado', $this->usuEncargado])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'rolCodigo', $this->rolCodigo]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchAdmin($params)
    {
        $query = User::find();
        $rolesUsuario = Roles::listarRoles();

        foreach ($rolesUsuario  as $key => $value) {
            $respuesta[$value] = $key;
        }

        $query->andFilterWhere(['NOT LIKE', 'rolCodigo', $respuesta['Super Administrador']])
            ->andFilterWhere(['NOT LIKE', 'rolCodigo', $respuesta['Administrador']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['LIKE', 'usuCodigo', $this->usuCodigo])
            ->andFilterWhere(['LIKE', 'nombre1', $this->nombre1])
            ->andFilterWhere(['LIKE', 'apellido1', $this->apellido1])
            ->andFilterWhere(['LIKE', 'correo', $this->correo])
            ->andFilterWhere(['LIKE', 'insCodigo', $this->insCodigo])
            ->andFilterWhere(['LIKE', 'usuEncargado', $this->usuEncargado])
            ->andFilterWhere(['LIKE', 'estado', $this->estado])
            ->andFilterWhere(['NOT LIKE', 'rolCodigo', $this->rolCodigo]);

        return $dataProvider;
    }
}
