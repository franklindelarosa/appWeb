<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
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

    /**
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarios();
        if ($model->load(Yii::$app->request->post())) {
            $model->contrasena = sha1($model->contrasena);
            $model->accessToken = md5(time());
            if($model->perfil === '' || $model->perfil === NULL){
                $model->perfil = 'Jugador';
            }
            $model->usuario = $model->correo;
            if($model->save()){
                $role = Yii::$app->authManager->getRole($model->perfil);
                Yii::$app->authManager->assign($role, $model->id_usuario);
                return $this->redirect(['view', 'id' => $model->id_usuario]);
            }else{
                return $this->redirect(['create']);
            }
        } else {
            $fecha = date('Y');
            $fecha_min = strtotime('-65 year', strtotime($fecha));
            $fecha_max = strtotime('-10 year', strtotime($fecha));
            $fecha_min = date('Y',$fecha_min);
            $fecha_max = date('Y',$fecha_max);
            $rango_fecha = ''.$fecha_min.':'.$fecha_max;
            $query = new Query;
            $roles = $query->select('name')->from('items')->all();
            $posiciones = $query->select('*')->from('posiciones')->all();
            return $this->render('create', [
                'model' => $model,
                'roles' => $roles,
                'posiciones' => $posiciones,
                'rango_fecha' => $rango_fecha,
            ]);
        }
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $contrasena = $model->contrasena;

        if(Yii::$app->user->id===$model->id || Yii::$app->user->can('Administrador')){
            if ($model->load(Yii::$app->request->post())) {
                ($model->contrasena === '') ? $model->contrasena = $contrasena : $model->contrasena = sha1($model->contrasena);
                $role = Yii::$app->authManager->getRole($model->perfil);
                if($model->perfil !== ''){
                    Yii::$app->authManager->revokeAll($id);
                    Yii::$app->authManager->assign($role, $id);
                }
                $model->usuario = $model->correo;
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id_usuario]);
                }else{
                    return $this->redirect(['update', 'id' => $model->id_usuario]);
                }
            } else {
                $fecha = date('Y');
                $fecha_min = strtotime('-65 year', strtotime($fecha));
                $fecha_max = strtotime('-10 year', strtotime($fecha));
                $fecha_min = date('Y',$fecha_min);
                $fecha_max = date('Y',$fecha_max);
                $rango_fecha = ''.$fecha_min.':'.$fecha_max;
                $query = new Query;
                $roles = $query->select('name')->from('items')->all();
                $posiciones = $query->select('*')->from('posiciones')->all();
                $estados = $query->select('*')->from('estados')->where('entidad = "usuarios"')->all();
                return $this->render('update', [
                    'model' => $model,
                    'estados' => $estados,
                    'roles' => $roles,
                    'posiciones' => $posiciones,
                    'rango_fecha' => $rango_fecha,
                ]);
            }
        }else{
            throw new \yii\web\HttpException(403, 'No tiene permisos para ejecutar esta acción');
        }
    }

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // Yii::$app->authManager->revokeAll($id);
        // $this->findModel($id)->delete();
        // $transaction = \Yii::$app->db->beginTransaction();
        // try {
        //     $sql = "DELETE FROM usuarios_partidos ut, partidos p WHERE ut.id_partido = p.id_partido AND ut.id_usuario = ".$id." AND p.estado = 5";
        //     \Yii::$app->db->createCommand($sql)->execute();
        //     $sql = "DELETE FROM invitaciones WHERE id_partido = ".$_POST['partido']." AND id_usuario = ".$_POST['jugador'];
        //     \Yii::$app->db->createCommand($sql)->execute();
        //     $sql = "DELETE FROM invitados WHERE id_invitado = ".$id;
        //     \Yii::$app->db->createCommand($sql)->execute();
        //     $transaction->commit();
        //     $result['mensaje'] = 'ok';
        // } catch (Exception $e) {
        //     $result['mensaje'] = 'bad';
        //     $transaction->rollBack();
        // }
        // $model = $this->findModel($id);
        // $model->estado = 5;
        // if($model->save(false)){

        // }
        // return $this->redirect(['index']);
        try {
            Yii::$app->authManager->revokeAll($id);
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } catch (yii\db\IntegrityException $e) {
            // throw new NotFoundHttpException('');
            throw new \yii\web\HttpException(403, 'No se puede eliminar un usuario con partidos activos');
        }
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
