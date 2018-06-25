<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'password',
            'email:email',
            'phone',
            'realname',
            'avatar',
            'sex',
            'state',
            'last_login_time',
            'last_login_ip',
            'created_at',
            'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{disable} {enable}',
                'buttons' => [
                    'disable' => function ($url, $model, $key) {
                        $options = ['title' => '禁用', 'data-confirm' => '确认要禁用此用户吗？'];
                        return $model->state ? Html::a('禁用', $url, $options) : '';
                    },
                    'enable' => function ($url, $model, $key) {
                        $options = ['title' => '启用', 'data-confirm' => '确认要启用此用户吗？'];
                        return !$model->state ? Html::a('启用', $url, $options) : '';
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
