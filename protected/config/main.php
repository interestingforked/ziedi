<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Aizietziedi.lv',
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'storm',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'user' => array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
            'captcha' => array('registration' => false),
            'recoveryUrl' => array('/user/recovery'),
        ),
        'admin' => array()
    ),
    'behaviors' => array(
        'ApplicationConfigBehavior'
    ),
    'components' => array(
        'user' => array(
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        'urlManager' => array(
            'class' => 'UrlManager',
            'urlFormat' => 'path',
            'rules' => array(
                '/' => 'site/index',
            ),
            'showScriptName' => false,
            'caseSensitive' => true,
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=ziedi',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'persistent' => true,
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                /*
                array(
                    'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1'),
                ),
                 */
            ),
        ),
    ),
    'params' => array(
        'adminEmail' => 'webmaster@example.com',
        'languages' => array(
            'ru' => 'Russian',
            'lv' => 'Latvian'
        ),
        'defaultLanguage' => 'lv',
        'currencies' => array(
            'EUR' => ' &euro;',
            'LVL' => ' Ls'
        ),
        'currency' => 'LVL',
        'images' => '/images/products/',
        'categories' => '/images/categories/',
        'pages' => '/images/pages/',
        'backgrounds' => '/images/backgrounds/',
        'articles' => '/images/articles/',
        'blocks' => '/images/blocks/',
        'gallery' => '/images/gallery/',
        'thumbUrl' => '/assets/thumb.php',
        'size_limit' => 10 * 1024 * 1024,
        'tmp_upload_dir' => 'assets/tmp/',
        'adminIcons' => array(
            'arrow_up' => '/images/admin/arrow_up.png',
            'arrow_down' => '/images/admin/arrow_down.png',
            'empty' => '/images/admin/empty.gif',
        ),
    ),
);