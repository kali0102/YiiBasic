<?php

namespace app\modules\manage\controllers;


use Yii;
use app\models\Admin;
use app\helpers\Constant;
use yii\filters\VerbFilter;
use app\models\AdminSearch;
use app\helpers\CController;

/**
 * 管理员
 * @author
 */
class AdminController extends CController
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

    /**
     * 列表
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 添加
     */
    public function actionCreate()
    {
        $model = new Admin;
        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['index']);
        return $this->render('create', ['model' => $model]);
    }

    /**
     * 编辑
     * @param $id
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        return $this->render('update', ['model' => $model]);
    }

    /**
     * 禁用
     * @param $id
     */
    public function actionDisable($id)
    {
        $model = $this->loadModel($id);
        $model->state = Constant::STATE_DISABLED;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * 启用
     * @param $id
     */
    public function actionEnable($id)
    {
        $model = $this->loadModel($id);
        $model->state = Constant::STATE_NORMAL;
        $model->save();
        return $this->redirect(['index']);
    }
}
