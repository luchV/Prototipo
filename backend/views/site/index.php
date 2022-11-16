<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<style type="text/css">
    body {
        background-image: var(--imagen-doby-inicio);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    main {
        background-image: none;

    }

    .estiloGlobal {
        box-shadow: 0px 0px 50px 0px rgb(0 0 0 / 20%);
        background: transparent;
        overflow: auto;
    }
</style>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">¡Bienvenido <br><?= Yii::$app->user->identity->nombre1 ?>!</h1>
    </div>
</div>