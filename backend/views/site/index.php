<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
var_dump(bin2hex(openssl_random_pseudo_bytes(20)));
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">¡Bienvenido <?= Yii::$app->user->identity->nombre1 ?> al prototipo de Software para estimulación fonoaudiológica!</h1>
    </div>
</div>