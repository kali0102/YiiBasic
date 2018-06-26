<?php if (!Yii::$app->getUser()->isGuest): ?>
    <div class="manage-default-index">
        <h1><?= Yii::$app->user->identity->username ?></h1>
        <p><?= \yii\helpers\Html::a('退出', ['/signout']) ?></p>
    </div>
<?php endif; ?>