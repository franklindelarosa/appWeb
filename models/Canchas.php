<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "canchas".
 *
 * @property integer $id_cancha
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 * @property integer $cupo_max
 *
 * @property Partidos[] $partidos
 */
class Canchas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'canchas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'direccion', 'telefono', 'cupo_max'], 'required'],
            [['cupo_max'], 'integer'],
            [['nombre', 'direccion', 'telefono'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cancha' => 'Id Cancha',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'cupo_max' => 'Cupo Max',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartidos()
    {
        return $this->hasMany(Partidos::className(), ['id_cancha' => 'id_cancha']);
    }
}
