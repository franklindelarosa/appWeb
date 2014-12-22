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
            $model->accessToken = $model->contrasena;
            if($model->perfil === '' || $model->perfil === NULL){
                $model->perfil = 'Jugador';
            }
            $model->usuario = $model->correo;
            if($model->save()){
                $role = Yii::$app->authManager->getRole($model->perfil);
                Yii::$app->authManager->assign($role, $model->id_usuario);
                return $this->redirect(['view', 'id' => $model->id_usuario]);
            }
        } else {
            $query = new Query;
            $roles = $query->select('name')->from('items')->all();
            return $this->render('create', [
                'model' => $model,
                'roles' => $roles,
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
                $model->accessToken = $model->contrasena;
                $role = Yii::$app->authManager->getRole($model->perfil);
                if($model->perfil !== ''){
                    Yii::$app->authManager->revokeAll($id);
                    Yii::$app->authManager->assign($role, $id);
                }
                $model->usuario = $model->correo;
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id_usuario]);
                }
            } else {
                $query = new Query;
                $roles = $query->select('name')->from('items')->all();
                $estados = $query->select('*')->from('estados')->where('entidad = "usuarios"')->all();
                return $this->render('update', [
                    'model' => $model,
                    'estados' => $estados,
                    'roles' => $roles,
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
        Yii::$app->authManager->revokeAll($id);
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
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
