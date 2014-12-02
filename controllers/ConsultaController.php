<?php

namespace app\controllers;

use Yii;
use app\models\Consulta;
use app\models\ConsultaSearch;
use yii\web\Controller;

class ConsultaController extends Controller
{
    public function actionIndex()
    {
    	$searchModel = new ConsultaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEquipos(){
    	$sql = "CALL jugadoresEquipo('b',".$_POST['id'].")";
        $equipos[0] = \Yii::$app->db->createCommand($sql)->queryAll();
        $sql = "CALL jugadoresEquipo('n',".$_POST['id'].")";
        $equipos[1] = \Yii::$app->db->createCommand($sql)->queryAll();
        $equipos[2] = max(count($equipos[0]),count($equipos[1]));
        \Yii::$app->response->format = 'json';

        return $equipos;
    }

    public function actionUsuario(){
        $query = (new \yii\db\Query());
        $query->select('nombre,usuario,sexo,telefono')->from('Usuarios')->where('id_usuario =:id');
        $query->addParams(['id'=>$_POST['id']]);
        $user = $query->one();
        \Yii::$app->response->format = 'json';

        return $user;
    }

}
