<?php
class DefaultModulePlugin extends Yaf_Plugin_Abstract
{ 
    // routerStartup	在路由之前触发	这个是7个事件中, 最早的一个. 但是一些全局自定的工作, 还是应该放在Bootstrap中去完成
    public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
    } 
    // routerShutdown	路由结束之后触发	此时路由一定正确完成, 否则这个事件不会触发
    public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        $module = $request -> getModuleName();
        $controller = $request -> getControllerName();
        $action = $request -> getActionName();
        $config = Yaf_Registry :: get("config");

        //设置默认模块
        if ( $module == 'Index' ){
            $request -> setModuleName("Front");
            $request -> setControllerName("Index");
            $request -> setActionName("index");
        }
        // 在该页面中可以设置smarty变量，在所有页面中都添加
    } 
} 
