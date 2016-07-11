<?php
class DefaultModulePlugin extends Yaf_Plugin_Abstract
{ 
    // routerStartup	��·��֮ǰ����	�����7���¼���, �����һ��. ����һЩȫ���Զ��Ĺ���, ����Ӧ�÷���Bootstrap��ȥ���
    public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
    } 
    // routerShutdown	·�ɽ���֮�󴥷�	��ʱ·��һ����ȷ���, ��������¼����ᴥ��
    public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        $module = $request -> getModuleName();
        $controller = $request -> getControllerName();
        $action = $request -> getActionName();
        $config = Yaf_Registry :: get("config");

        //����Ĭ��ģ��
        if ( $module == 'Index' ){
            $request -> setModuleName("Front");
            $request -> setControllerName("Index");
            $request -> setActionName("index");
        }
        // �ڸ�ҳ���п�������smarty������������ҳ���ж����
    } 
} 
