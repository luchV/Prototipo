<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/login.css',
        'css/coloresBack.css',
        'css/barraLateral.css',
        'css/general.css',
        'css/botonCheckBox.css',
    ];
    public $js = [
        'https://kit.fontawesome.com/41bcea2ae3.js',
        'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
        'js/login.js',
        'js/reproductor.js',
        'js/contraerMenu.js',
        'js/funcionesGenerales.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
    public function init()
    {
        parent::init();
        $this->publishOptions['beforeCopy'] = function ($from, $to) {
            $dirname = basename(dirname($from));
            return $dirname === 'fonts' || $dirname === 'css';
        };
    }
}
