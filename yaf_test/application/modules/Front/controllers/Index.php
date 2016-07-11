<?php
class IndexController extends Yaf_Controller_Abstract
{
    private $logger;
    
    /**
     * 构造函数
     * 
     * @param array $config 
     */
    public function init()
    {
        $this -> initParams();
    } 

    /**
     * 初始化调用是的参数
     */
    public function initParams()
    {
        $this->logger = Yaf_Registry::get("logger");
    } 
    
    public function indexAction()
    {
        $smarty = Yaf_Registry :: get("smarty");

        $smarty -> assign("page", '首页');
        $smarty -> display('Front/index/index.phtml');
    } 
    
    // 读取配置文件
    public function configAction()
    {
       $config = Yaf_Application :: app() -> getConfig();
        print_r($config);
        echo "<br/>";
        print_r( $config->routes);
        echo "<br/>";
        //得到配置文件
        echo $config->routes->simple->type . "<br/>";
 
        echo "<br/>";
        echo $config->get("redis_eby_redis")->host . "<br/>";
        print_r($config->get("redis_eby_redis"));
        echo "<br/>";
        print_r($config->redis_eby_redis);
        echo "<br/>";
    } 
    
    public function osAction()
    {
        if(Utils_Util::isWindows()){
            echo "win";
        }else{
            echo "linux";
        }
        exit;
    } 
    
    public function logAction()
    {
        $param = array(
            "id" =>1,
            "name" => "kk"
        );
        $this->logger->debug("debug");
        $this->logger->info($param);
    } 
    
    
    public function pinyinAction()
    {
        $pinyin = new Pinyin_Adapter();
        echo $pinyin->pinyin("孔智慧");
    } 
    
    public function redisAction()
    {
        $redis = new RedisBaseModel();
        echo $redis->get("token_34") . "<br/>";
    } 
    
    public function dbAction()
    {
        $user = new UserModel();
        // 查询
        $kong = $user->getRowById(195);
        print_r($kong);
        echo "<br/>";
        
        // 添加, 添加的字段由 param来决定
        // $param = array("username" => "_test","password" => "pwd");
        // $user->add($param);

        // 删除
        // $u = $user->getRowById(452);
        // $condition = " `id` = ?";
        // $valueAry[] = $u["id"];
        // $user->del($condition,$valueAry);

        // 编辑
        // $u = $user->getRowById(453);
        // $u["ss"] =  12345;
        // $u["realname"] = "控制";
        // $condition = " `id` = ? ";
        // $conditionValAry[] = $u["id"];
        // $user->edit($condition,$conditionValAry,$u);

        // 通用的Model
        $mod = new Service_BackEndBase("UserModel");
        print_r($mod->getRowById(195));
        echo "<br/>";
    } 
} 
