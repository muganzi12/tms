<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            //'authTimeout' => 600,
        // You inserted it here
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'fileStorage' => [
            'class' => 'trntv\filekit\Storage',
            'baseUrl' => '@web/uploads'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'app_module' => function() {
            return 2; //Frontend APP
        },
        'member' => function() {
            return common\models\User::findLoggedInUser();
        },
        'errorHandler' => [
            
            'errorAction' => 'site/error',
        ],
        /*
          'urlManager' => [
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'rules' => [
          ],
          ],
         */
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/flowdash',
                    'js' => [
                        'assets/vendor/jquery.min.js',
                    ],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/flowdash',
                    'js' => [
                        'assets/vendor/bootstrap.min.js'
                    ],
                    'css' => [
                        'css/bootstrap.less'
                    ],
                ],
            ],
        ],
    ],
    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module']
    ],
    'params' => $params,
];
