<?php
date_default_timezone_set('Asia/shanghai');
define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* ָ��public����һ�� */
$app  = new Yaf_Application(APP_PATH . "/conf/application.ini");
$app
->bootstrap()
->run();