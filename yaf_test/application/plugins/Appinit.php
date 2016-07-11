<?php
class AppinitPlugin extends Yaf_Plugin_Abstract {

    public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {

    }

    public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
        $module = $request->getModuleName();
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        $this->registerLog($module, $controller, $action);
    }

    /**
     *  注册日志工具实例
     */
    private function registerLog($module, $controller, $action){
        $filepath = '/data/logs/php-run-';
        if (Utils_Util::isWindows()){
            $filepath = "D:/data/logs/php/php-run-";
        }
        $logfile = $filepath . date( 'Y-m-d' , time()).'.log' ;  
        $conf = array(  
               'locking' => 1,
               'append' => true,
               'mode' => 0644,
               'dirmode' => 0755,
               'lineFormat' => '%1$s %2$s [%3$s] %4$s',
               'timeFormat' => '[%d-%b-%Y %H:%M:%S]',
               'eol' => "\n",

        );
        $ident = $module."-".$controller."-".$action;
        $logger = Log_Adapter::singleton("file" , $logfile, $ident, $conf, PEAR_LOG_DEBUG);
        Yaf_Registry::set("logger", $logger);
    }

}