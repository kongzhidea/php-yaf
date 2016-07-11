<?php
class IndexController extends Yaf_Controller_Abstract
{
    // 使用路由后，这个类不再用
    public function indexAction() // 默认Action
    {
        $this -> getView() -> assign("content", "Hello World");
    } 
    
    //访问地址 http://localhost:8105/index/test
    public function testAction()
    {
        echo 'test';
        exit;
    } 
} 

?>
