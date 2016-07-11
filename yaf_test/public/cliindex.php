<?php
date_default_timezone_set('Asia/shanghai');
define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */
$app  = new Yaf_Application(APP_PATH . "/conf/application.ini");
if( $argc >= 4){
    $config = Yaf_Application::app()->getConfig();
    Yaf_Registry::set("config", $config);
    $app->getDispatcher()->dispatch(new Yaf_Request_Simple("CLI", $argv[1], $argv[2], $argv[3], array("argc" => $argc, "argv" => $argv)));
}else{
    echo "params expact >=4:\n";
    echo "\t",'$argv[1]-module, $argv[2]-controller, $argv[3]-action', "\n";
    exit();
}
//样例(Front一直出错) php cliindex.php Api Index test
