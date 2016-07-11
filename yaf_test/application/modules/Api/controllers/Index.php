<?php
class IndexController extends Yaf_Controller_Abstract
{
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
    } 
    
    public function indexAction()
    {
        $smarty = Yaf_Registry :: get("smarty");

        $smarty -> assign("page", 'API');
        $smarty -> display('Front/index/index.phtml');
    } 
    
    public function testAction()
    {
        $pinyin = new Pinyin_Adapter();
        echo $pinyin->pinyin("孔智慧");
        
        $user = new UserModel();
        // 查询
        $kong = $user->getRowById(195);
        print_r($kong);
        
        exit(1);
    } 
    
} 
