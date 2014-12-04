<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id_usuario
 * @property string $nombre
 * @property string $usuario
 * @property string $contrasena
 * @property string $sexo
 * @property string $perfil
 * @property integer $estado
 * @property string $telefono
 * @property string $correo
 *
 * @property Invitaciones[] $invitaciones
 * @property Estados $estado
 * @property UsuariosPartidos[] $usuariosPartidos
 */
class Usuarios extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'usuario', 'contrasena', 'sexo'], 'required'],
            [['estado'], 'integer'],
            [['nombre', 'usuario', 'perfil', 'correo'], 'string', 'max' => 45],
            [['contrasena'], 'string', 'max' => 70],
            [['sexo'], 'string', 'max' => 1],
            [['telefono'], 'string', 'max' => 20],
           [['usuario'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'usuario' => 'Usuario',
            'contrasena' => 'Contrasena',
            'sexo' => 'Sexo',
            'perfil' => 'Perfil',
            'estado' => 'Estado',
            'telefono' => 'Telefono',
            'correo' => 'Correo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitaciones()
    {
        return $this->hasMany(Invitaciones::className(), ['id_usuario' => 'id_usuario']);
    }

    public function getEstado()
    {
        return $this->hasOne(Estados::className(), ['id_estado' => 'estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariosPartidos()
    {
        return $this->hasMany(UsuariosPartidos::className(), ['id_usuario' => 'id_usuario']);
    }

    public function getId()
    {
        return $this->id_usuario;
    }

    public static function findIdentity($id)
    {
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        $usuario = Usuarios::find()->where(['id_usuario' => $id])->one();
        if ($usuario !== null) {
            return new static($usuario);
        }
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $usuario = Usuarios::find()->where(['accessToken' => $toke])->one();
        if ($usuario['accessToken'] !== null) {
            return new static($usuario);
        }
        return null;
    }

    public function getUsername(){
        return $this->usuario;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    
    public function validatePassword($password)
    {
        return $this->contrasena === sha1($password);
    }

    public static function findByUsername($username)
    {
        $usuario = Usuarios::find()->where(['usuario' => $username])->one();
        if ($usuario !== null) {
            return new static($usuario);
        }
        return null;
    }
}
