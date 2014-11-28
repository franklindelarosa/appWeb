<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Partidos;

/**
 * PartidosSearch represents the model behind the search form about `app\models\Partidos`.
 */
class PartidosSearch extends Partidos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partido', 'estado', 'id_cancha'], 'integer'],
            [['fecha', 'hora'], 'safe'],
            [['costo'], 'number'],
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
        $query = Partidos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_partido' => $this->id_partido,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'costo' => $this->costo,
            'estado' => $this->estado,
            'id_cancha' => $this->id_cancha,
        ]);

        return $dataProvider;
    }
}
