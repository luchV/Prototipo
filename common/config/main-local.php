<?php
$bd = validarBase();
$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => "mysql:host=localhost;dbname={$bd}",
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        
        // Dynamic connections using empresa get params 
        // 'mongodb'     => [
        //     'class' => \yii\mongodb\Connection::class,
        //     'dsn' => "mongodb+srv://TesisUda22:Tesis2020@cluster0.kfp3c.mongodb.net/{$bd}?retryWrites=true&w=majority",
        // ]
    ],
];
// var_dump($config );exit;
return $config;
