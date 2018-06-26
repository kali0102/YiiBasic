<?php if (!Yii::$app->admin->isGuest): ?>
    <div class="manage-default-index">
        <h1><?= Yii::$app->admin->identity->username ?></h1>
        <p><?= \yii\helpers\Html::a('退出', ['/manage/signout']) ?></p>
    </div>
<?php endif; ?>
