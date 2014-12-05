<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Consulta;
use app\models\ConsultaSearch;
use app\models\Invitados;
use app\models\Usuarios;
use yii\web\Controller;
use yii\db\Query;

class ConsultaController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['index', 'logout'],
                'rules' => [
                    [
                        'allow' => false,
                        // 'actions' => ['index'],
                        'roles' => ['?'],
                    ],
                    [
                        // 'actions' => ['index', 'logout'],
                        'allow' => true,
                        'roles' => ['Administrador'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
    	$searchModel = new ConsultaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRegistrarinvitado(){
        if(Yii::$app->request->post() && isset($_POST['data'])){
            parse_str($_POST['data'], $data);
            if(isset($data['bool']) && $data['bool'] == "on"){
                $usuario = new Usuarios();
                $usuario->nombre = $data['nombre'];
                $usuario->correo = $data['correo'];
                $usuario->usuario = $data['correo'];
                $usuario->sexo = $data['sexo'];
                $usuario->telefono = $data['telefono'];
                $usuario->contrasena = sha1($data['telefono']);
                if($usuario->save()){
                    $sql = "INSERT INTO usuarios_partidos (id_usuario, id_partido, equipo) VALUES ('".$usuario->id_usuario."', '".$data['partido']."', '".strtolower(substr($data['equipo'],0,1))."')";
                    \Yii::$app->db->createCommand($sql)->execute();
                }
                $result['entidad'] = 'usuario';
                $result['id'] = $usuario->id_usuario;
            }else{
                $invitado = new Invitados();
                $invitado->nombre = $data['nombre'];
                $invitado->correo = $data['correo'];
                $invitado->sexo = $data['sexo'];
                $invitado->telefono = $data['telefono'];
                if($invitado->save()){
                    $sql = "INSERT INTO invitaciones (id_usuario, id_invitado, equipo) VALUES ('".Yii::$app->user->id."', '".$invitado->id_invitado."', '".strtolower(substr($data['equipo'],0,1))."')";
                    \Yii::$app->db->createCommand($sql)->execute();
                }
                $result['entidad'] = 'invitado';
                $result['id'] = $invitado->id_invitado;
            }
        }
        \Yii::$app->response->format = 'json';
        return $result;
    }
    public function actionEquipos(){
    	$sql = "CALL jugadoresEquipo('b',".$_POST['id'].")";
        $equipos[0][0] = \Yii::$app->db->createCommand($sql)->queryAll();
        $sql = "CALL invitadosEquipo('b',".$_POST['id'].")";
        $equipos[0][1] = \Yii::$app->db->createCommand($sql)->queryAll();
        $sql = "CALL jugadoresEquipo('n',".$_POST['id'].")";
        $equipos[1][0] = \Yii::$app->db->createCommand($sql)->queryAll();
        $sql = "CALL invitadosEquipo('n',".$_POST['id'].")";
        $equipos[1][1] = \Yii::$app->db->createCommand($sql)->queryAll();
        $sql = "SELECT c.cupo_max max FROM canchas c, partidos p WHERE p.id_partido = ".$_POST['id']." AND c.id_cancha = p.id_cancha" ;
        $equipos[2] = \Yii::$app->db->createCommand($sql)->query();
        // = max(count($equipos[0]),count($equipos[1]));
        \Yii::$app->response->format = 'json';

        return $equipos;
    }

    public function actionUsuario(){
        $sql = "SELECT nombre,usuario,correo,(if(sexo = 'f','Femenino','Masculino')) sexo,telefono FROM usuarios WHERE id_usuario = ".$_POST['id'];
        $user = \Yii::$app->db->createCommand($sql)->queryOne();
        \Yii::$app->response->format = 'json';

        return $user;
    }

    public function actionInvitado(){
        $sql = "SELECT nombre,correo,(if(sexo = 'f','Femenino','Masculino')) sexo,telefono FROM invitados WHERE id_invitado = ".$_POST['id'];
        $guest = \Yii::$app->db->createCommand($sql)->queryOne();
        \Yii::$app->response->format = 'json';
        return $guest;
    }

}
