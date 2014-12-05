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
    public $canchaName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partido', 'estado', 'blancos', 'negros', 'id_cancha'], 'integer'],
            [['fecha', 'hora'], 'safe'],
            [['costo', 'venta'], 'number'],
            [['canchaName'], 'safe'],
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
        $query = Partidos::find()->orderBy(['fecha' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['idCancha']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_partido' => $this->id_partido,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'costo' => $this->costo,
            'venta' => $this->venta,
            'estado' => $this->estado,
            'blancos' => $this->blancos, 
            'negros' => $this->negros, 
            'id_cancha' => $this->id_cancha,
        ]);

        $query->joinWith(['idCancha' => function ($q) {
            $q->where('canchas.nombre LIKE "%' . $this->canchaName . '%"');
        }]);

        return $dataProvider;
    }
}
