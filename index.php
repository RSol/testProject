<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';

switch ($_SERVER['SERVER_NAME']) {
    case "zigmund":
        $config=dirname(__FILE__).'/protected/config/mainZigmund.php';
        break;
    case "teodor":
        $config=dirname(__FILE__).'/protected/config/mainTeodor.php';
        break;
    case "joker":
        $config=dirname(__FILE__).'/protected/config/mainJoker.php';
        break;
    case "rodriges":
        $config=dirname(__FILE__).'/protected/config/mainRodriges.php';
        break;
    case "pumpam":
        $config=dirname(__FILE__).'/protected/config/mainPumpam.php';
        break;
    case "test.local":
        $config=dirname(__FILE__).'/protected/config/mainTest.php';
        break;
}
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
