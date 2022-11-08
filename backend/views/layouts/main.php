<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use common\models\Params;
use common\widgets\MenuCarga;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <link type="image/x-icon" href="<?= Params::ICONO ?>" rel="shortcut icon" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100" id="body">
    <?php $this->beginBody() ?>

    <header>

        <div class="icon__menu">
            <em class="fas fa-bars" id="btn_open"></em>
        </div>
        <?php
        NavBar::begin([
            'options' => [
                'class' => 'navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);
        ?>
        <?php
        $menuItems = [
            ['label' => Yii::$app->user->identity->nombre1, 'url' => ['usuarios/informacion']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'], ['onclick' => 'ingresarVariableMenu("desplegar", "")'])
                . Html::submitButton(
                    'Cerrar sesión',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        $this->registerJsFile(
            'js/barraLateral.js'
        );
        ?>

    </header>

    <?= MenuCarga::widget(); ?>

    <main role="main" class="flex-shrink-0">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-left">&copy; <?= Params::NOMBREPROGRAMA ?> <?= date('Y') ?></p>
            <p class="float-right"> Powered by Luis Vásconez</p>
        </div>
    </footer>

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage();
