<?php

/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */

class Bootstrap extends Yaf_Bootstrap_Abstract
{
    private $config; 
    // 注册config文件
    public function _initConfig()
    {
        $this -> config = Yaf_Application :: app() -> getConfig();
        Yaf_Registry :: set("config", $this -> config);
        $config = Yaf_Registry :: get("config"); 
        // 得到配置文件中值，例如$config->routes->simple->type
    } 

    public function _initError()
    {
        error_reporting (-1);
        ini_set('display_errors', 'On');
    } 
    // smarty模板, 在library中
    public function _initSmarty(Yaf_Dispatcher $dispatcher)
    {
        Yaf_Loader :: import("smarty/Adapter.php");
        $smarty = new Smarty_Adapter(null, Yaf_Registry :: get("config") -> get("smarty"));
        Yaf_Registry :: set("smarty", $smarty);
        $dispatcher -> setView($smarty);
    } 

    public function _initViewParameters(Yaf_Dispatcher $dispatcher)
    {
        Yaf_Dispatcher :: getInstance() -> autoRender(FALSE); // 关闭自动加载模板  important
    } 

    public function _initSesson()
    {
    } 

    /**
     * 过滤全局变量$_GET, $_POST, $_COOKIE等
     * 
     * @return void 
     * @param void $ 
     */
    public function _initGlobalFilter()
    {
    } 

    public function _initRoute(Yaf_Dispatcher $dispatcher)
    {
        $router = Yaf_Dispatcher :: getInstance() -> getRouter();
        /**
         * 添加配置中的路由
         */
        $router -> addConfig(Yaf_Registry :: get("config") -> routes);
    } 

    public function _initPlugin(Yaf_Dispatcher $dispatcher)
    {
        //设置默认的模块
        $default = new DefaultModulePlugin();
        $dispatcher->registerPlugin($default);
        //设置log
        $log = new AppinitPlugin();
        $dispatcher->registerPlugin($log);

    } 

    public function _initDefaultName(Yaf_Dispatcher $dispatcher)
    {
        $dispatcher->setDefaultModule("Index")->setDefaultController("Index")->setDefaultAction("index");
    } 
} 
