<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Consulta;

/**
 * ConsultaSearch represents the model behind the search form about `app\models\Contactos`.
 */
class ConsultaSearch extends Consulta
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['Fecha', 'Hora', 'Cancha', 'Direccion', 'Telefono', 'Cupo', 'Total', 'Blancos', 'Negros'], 'safe'],
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

        $query = Consulta::find()->orderBy(['Fecha' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // $query->andFilterWhere([
        //     'id_contacto' => $this->id_contacto,
        //     'id_proveedor' => $this->id_proveedor,
        //     'id_cliente' => $this->id_cliente,
        //      'borrado' => $this->borrado,
        // ]);  

        $query->andFilterWhere(['like', 'Fecha', $this->Fecha])
            ->andFilterWhere(['like', 'Hora', $this->Hora])
            ->andFilterWhere(['like', 'Cancha', $this->Cancha])
            ->andFilterWhere(['like', 'Direccion', $this->Direccion])
            ->andFilterWhere(['like', 'Telefono', $this->Telefono])
            ->andFilterWhere(['like', 'Cupo', $this->Cupo])
            ->andFilterWhere(['like', 'Total', $this->Total])
            ->andFilterWhere(['like', 'Blancos', $this->Blancos])
            ->andFilterWhere(['like', 'Negros', $this->Negros]);
       
        return $dataProvider;
    }
}