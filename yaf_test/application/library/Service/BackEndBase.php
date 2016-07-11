<?php
class Service_BackEndBase  {

    /**
     * 构造函数
     * @param array $config
     */
    public function __construct($model){
         $this->modelObj = new $model();
    }

    public function getAll(){
        return $this->modelObj->getAll();
    }

    public function getList($condition, $valueAry, $order, $start, $offset){
        $result = array();
        $colum = " * ";
        $limit = " LIMIT {$start}, {$offset}";
        $result = $this->modelObj->getAllByCondition($colum, $condition, $valueAry, $group = '', $order, $limit);

        return $result;
    }

    public function getListCount($condition, $valueAry, $params){
        $result = array();
        $colum = " COUNT(*) as cnt ";
        $order = " ";
        $limit = " ";
        $result = $this->modelObj->getAllByCondition($colum, $condition, $valueAry, $group = '', $order, $limit);

        return $result[0]['cnt'];
    }

    public function getRowById($id){
        $result = array();
        $colum = " * ";
        $condition = " `id` = ? ";
        $valueAry[] = $id;
        $limit = " LIMIT 1";
        $result = $this->modelObj->getAllByCondition($colum, $condition, $valueAry, $group = '', $order = '', $limit);
        return isset($result[0]) ? $result[0] : array();
    }

    public function add($data){
        $result = array();
        $result = $this->modelObj->add($data);

        return $result;
    }

    public function edit($id, $data){
        $result = array();
        $condition = " `id` = ? ";
        $conditionValAry[] = $id;
        $result = $this->modelObj->edit($condition, $conditionValAry, $data);

        return $result;
    }

    public function del($id) {
        $condition = " `id` = ?";
        $valueAry[] = $id;
        $result = $this->modelObj->del($condition, $valueAry);

        return $result;
    }

}
