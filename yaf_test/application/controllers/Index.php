<?php
class IndexController extends Yaf_Controller_Abstract
{
    // ʹ��·�ɺ�����಻����
    public function indexAction() // Ĭ��Action
    {
        $this -> getView() -> assign("content", "Hello World");
    } 
    
    //���ʵ�ַ http://localhost:8105/index/test
    public function testAction()
    {
        echo 'test';
        exit;
    } 
} 

?>
