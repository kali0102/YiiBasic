<?php

namespace app\modules\manage\controllers;

use Yii;
use app\models\Admin;
use app\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\components\Constant;

class AdminController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Admin;
        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['index']);
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        return $this->render('update', ['model' => $model]);
    }

    public function actionDisable($id)
    {
        $model = $this->loadModel($id);
        $model->state = Constant::STATE_DISABLED;
        $model->save();
        return $this->redirect(['index']);
    }

    public function actionEnable($id)
    {
        $model = $this->loadModel($id);
        $model->state = Constant::STATE_NORMAL;
        $model->save();
        return $this->redirect(['index']);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function loadModel($id, $columns = ['*'], $condition = [])
    {
        $model = Admin::find();
        $model->select($columns);
        $model->where(['id' => $id]);
        $condition ? $model->andWhere($condition) : '';
        if (!$activeRecord = $model->one())
            throw new NotFoundHttpException;
        return $activeRecord;
    }
}
