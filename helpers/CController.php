<?php

namespace app\helpers;

use yii\web\Response;
use yii\widgets\ActiveForm;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;

class CController extends Controller
{
    public function loadModel($id, $columns = ['*'], $condition = [])
    {
        $model = null;
        $modelClass = ucfirst(Yii::$app->controller->id);
        eval('$model = \app\models\\' . $modelClass . '::find();');
        $model->select($columns)->where(['id' => $id]);
        $condition ? $model->andWhere($condition) : '';
        if ($activeRecord = $model->one())
            return $activeRecord;
        throw new NotFoundHttpException('页面未找到', 404);
    }

    /**
     * 上传文件
     * @param $model
     * @param $property
     * @param null $path 指定目录
     */
    public function fileUpload($model, $property, $path = null)
    {
        $attachment = UploadedFile::getInstance($model, $property);
        if ($attachment != null) {
            $webRoot = Yii::getAlias('@webroot');
            $dir = $path == null ? $property : $path;
            $saveDir = '/uploads/' . $dir . '/' . date('Ym');
            FileHelper::createDirectory($webRoot . $saveDir);
            $fileName = Yii::$app->security->generateRandomString(12);
            $filePath = $saveDir . '/' . $fileName . '.' . $attachment->extension;
            if ($attachment->saveAs($webRoot . $filePath))
                $model->$property = $filePath;
        }
    }

    /**
     * 执行AJAX表单验证
     * @param $model
     * @param null $attributes
     * @param null $formName
     * @return array
     */
    public function performAjaxValidation($model, $attributes = null, $formName = null)
    {
        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post(), $formName)) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model, $attributes);
            }
        }
    }
}