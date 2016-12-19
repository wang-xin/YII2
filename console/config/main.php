<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'app-console',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'console\controllers',
    'components'          => [
        'log'         => [
            'targets' => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class'           => 'yii\rbac\DbManager',
            'itemTable'       => 'yii2_auth_item',
            'assignmentTable' => 'yii2_auth_assignment',
            'itemChildTable'  => 'yii2_auth_item_child',
            'ruleTable'       => 'yii2_auth_rule',
        ],
    ],
    'params'              => $params,
];
