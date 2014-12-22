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
        // $query = new Query;
        // $usuarios = $query->select('*')->from('usuarios')->where('estado = "4"')->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            // 'usuarios' => $usuarios,
        ]);
    }

    public function actionRegistrarregistrado(){
        if(Yii::$app->request->post() && isset($_POST['data'])){
            parse_str($_POST['data'], $data);
            $transaction = \Yii::$app->db->beginTransaction();
            $user = Usuarios::findOne($data['usuario']);
            try {
                $sql = "INSERT INTO usuarios_partidos (id_usuario, id_partido, equipo) VALUES ('".$data['usuario']."', '".$data['partido']."', '".strtolower(substr($data['equipo'],0,1))."')";
                \Yii::$app->db->createCommand($sql)->execute();
                $sql = "UPDATE partidos SET ".strtolower($data['equipo'])."s = (".strtolower($data['equipo'])."s+1) WHERE id_partido = ".$data['partido'];
                \Yii::$app->db->createCommand($sql)->execute();
                $result['entidad'] = 'usuario';
                $result['id'] = $data['usuario'];
                $result['nombre'] = $user->nombres." ".$user->apellidos;
                $transaction->commit();
                $result['mensaje'] = 'ok';
            } catch (Exception $e) {
                $result['mensaje'] = 'bad';
                $transaction->rollBack();
            }
            \Yii::$app->response->format = 'json';
            return $result;
        }
    }

    public function actionSacarjugador(){
        if(Yii::$app->request->post() && isset($_POST['jugador']) && isset($_POST['entidad']) && isset($_POST['equipo']) && isset($_POST['partido'])){
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if($_POST['entidad'] === 'usuario'){
                    $sql = "DELETE FROM usuarios_partidos WHERE id_partido = ".$_POST['partido']." AND id_usuario = ".$_POST['jugador'];
                    \Yii::$app->db->createCommand($sql)->execute();
                    $sql = "SELECT id_invitado FROM invitaciones WHERE id_partido = ".$_POST['partido']." AND id_usuario = ".$_POST['jugador'];
                    $result['invitados'] = \Yii::$app->db->createCommand($sql)->queryAll();
                    $sql = "DELETE FROM invitaciones WHERE id_partido = ".$_POST['partido']." AND id_usuario = ".$_POST['jugador'];
                    \Yii::$app->db->createCommand($sql)->execute();
                }else{
                    $sql = "DELETE FROM invitaciones WHERE id_partido = ".$_POST['partido']." AND id_invitado = ".$_POST['jugador'];
                    \Yii::$app->db->createCommand($sql)->execute();
                }
                $sql = "UPDATE partidos SET ".strtolower($_POST['equipo'])."s = (".strtolower($_POST['equipo'])."s-1) WHERE id_partido = ".$_POST['partido'];
                \Yii::$app->db->createCommand($sql)->execute();
                $transaction->commit();
                $result['mensaje'] = 'ok';
            } catch (Exception $e) {
                $result['mensaje'] = 'bad';
                $transaction->rollBack();
            }
        }else{$result['mensaje'] = 'bad';}
        \Yii::$app->response->format = 'json';
        return $result;
    }

    public function actionRegistrarinvitado(){
        if(Yii::$app->request->post() && isset($_POST['data'])){
            parse_str($_POST['data'], $data);
            if(isset($data['bool']) && $data['bool'] == "on"){
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $usuario = new Usuarios();
                    $usuario->nombres = $data['nombres'];
                    $usuario->apellidos = $data['apellidos'];
                    $usuario->correo = $data['correo'];
                    $usuario->usuario = $data['correo'];
                    $usuario->sexo = $data['sexo'];
                    $usuario->telefono = $data['telefono'];
                    $usuario->contrasena = sha1($data['telefono']);
                    $usuario->accessToken = $usuario->contrasena;
                    if($usuario->save()){
                        $sql = "INSERT INTO usuarios_partidos (id_usuario, id_partido, equipo) VALUES ('".$usuario->id_usuario."', '".$data['partido']."', '".strtolower(substr($data['equipo'],0,1))."')";
                        \Yii::$app->db->createCommand($sql)->execute();
                        $sql = "UPDATE partidos SET ".strtolower($data['equipo'])."s = (".strtolower($data['equipo'])."s+1) WHERE id_partido = ".$data['partido'];
                        \Yii::$app->db->createCommand($sql)->execute();
                        $result['mensaje'] = 'ok';
                    }
                    $result['entidad'] = 'usuario';
                    $result['id'] = $usuario->id_usuario;
                    $transaction->commit();
                } catch (Exception $e) {
                    $result['mensaje'] = 'bad';
                    $transaction->rollBack();
                }
            }else{
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $invitado = new Invitados();
                    $invitado->nombres = $data['nombres'];
                    $invitado->apellidos = $data['apellidos'];
                    $invitado->correo = $data['correo'];
                    $invitado->sexo = $data['sexo'];
                    $invitado->telefono = $data['telefono'];
                    if($invitado->save()){
                        $sql = "INSERT INTO invitaciones (id_usuario, id_invitado, equipo, id_partido) VALUES ('".Yii::$app->user->id."', '".$invitado->id_invitado."', '".strtolower(substr($data['equipo'],0,1))."', '".$data['partido']."')";
                        \Yii::$app->db->createCommand($sql)->execute();
                        $sql = "UPDATE partidos SET ".strtolower($data['equipo'])."s = (".strtolower($data['equipo'])."s+1) WHERE id_partido = ".$data['partido'];
                        \Yii::$app->db->createCommand($sql)->execute();
                        $result['mensaje'] = 'ok';
                    }
                    $result['entidad'] = 'invitado';
                    $result['id'] = $invitado->id_invitado;
                    $transaction->commit();
                } catch (Exception $e) {
                    $result['mensaje'] = 'bad';
                    $transaction->rollBack();
                }
            }
            $result['nombre'] = $data['nombres']." ".$data['apellidos'];
            \Yii::$app->response->format = 'json';
            return $result;
        }
    }

    public function actionEquipos(){
        $transaction = \Yii::$app->db->beginTransaction();
        try {
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
            $transaction->commit();
        } catch (Exception $e) {
            $equipos['mensaje'] = 'bad';
            $transaction->rollBack();
        }
        \Yii::$app->response->format = 'json';
        return $equipos;
    }

    public function actionListadousuarios(){
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $sql = "SELECT * FROM usuarios_partidos WHERE id_partido = ".$_POST['id'];
            $total = \Yii::$app->db->createCommand($sql)->query()->getRowCount();
            ($total > 0) ? $sql = "SELECT DISTINCT id_usuario, CONCAT(nombres, ' ', apellidos) nombre FROM usuarios WHERE (id_usuario) NOT IN (SELECT id_usuario FROM usuarios_partidos WHERE id_partido = ".$_POST['id'].")" : $sql = "SELECT id_usuario, correo, CONCAT(nombres, ' ', apellidos) nombre FROM usuarios";
            $usuarios = \Yii::$app->db->createCommand($sql)->query();
            $transaction->commit();
        } catch (Exception $e) {
            $usuarios['mensaje'] = 'bad';
            $transaction->rollBack();
        }
        \Yii::$app->response->format = 'json';
        return $usuarios;
    }

    public function actionUsuario(){
        $sql = "SELECT CONCAT(nombres, ' ', apellidos) nombre, correo, (if(sexo = 'f','Femenino','Masculino')) sexo, telefono FROM usuarios WHERE id_usuario = ".$_POST['id'];
        $user = \Yii::$app->db->createCommand($sql)->queryOne();
        \Yii::$app->response->format = 'json';
        return $user;
    }

    public function actionInvitado(){
        $sql = "SELECT CONCAT(nombres, ' ', apellidos) nombre, correo, (if(sexo = 'f','Femenino','Masculino')) sexo, telefono FROM invitados WHERE id_invitado = ".$_POST['id'];
        $guest = \Yii::$app->db->createCommand($sql)->queryOne();
        \Yii::$app->response->format = 'json';
        return $guest;
    }

}
