<?php
error_reporting(E_ALL & ~E_NOTICE);

if ($_SERVER['HTTP_HOST'] != 'h5.mpyouxi.com') {
    header('location:http://h5.mpyouxi.com' . $_SERVER['REQUEST_URI']);
}

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
