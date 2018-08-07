<?php

/* @var $this yii\web\View */

$this->title = 'app';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>
        <?php echo \yii\helpers\Html::a('测试', ['/site/index', 'id' => 11, 'hashId' => 'abcd123efgh', 'num' => 22]); ?>
        <?php echo \yii\helpers\Html::a('测试无参index', ['/site']); ?>
        <?php echo \yii\helpers\Html::a('测试无参', ['/site/index']); ?>
    </div>
</div>
