<?php
function pa()
{
    $backtrace = debug_backtrace();
    $args = func_get_args();
    $matches = array();
    preg_match('|.*[\/\\\](.+)$|', $backtrace[0]['file'], $matches);
    $res = array($matches[1] . ': ' . $backtrace[0]['line'], $args);
    echo "<pre>";
    print_r($res);
    echo "</pre>";
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
