<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';

$sn = explode('.', $_SERVER['SERVER_NAME']);


if(file_exists(dirname(__FILE__).'/protected/config/'.$sn[0].'.php')){
	$config=dirname(__FILE__).'/protected/config/'.$sn[0].'.php';
} else {
	$config=dirname(__FILE__).'/protected/config/mainTest.php';
}

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
