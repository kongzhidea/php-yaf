<?php
Abstract Class CommonModel extends BaseModel{
    public $table;
    public function __construct(){
        parent::__construct();
        $this->table = '';
    }

    /**
     * 添加
     * @param $data array
     * @param $dbname string
     * @return int
     *
     */
    public function add($data, $dbname = 'eby_master_rw'){
        $result = $this->insert($data, $this->table, $dbname);
        return $result;
    }

    public function addDatas($datas, $dbname = 'eby_master_rw'){
        $result = $this->insertValues($datas, $this->table, $dbname);
        return $result;
    }

    /**
     * 更新
     * @param $condition string
     * @param $conditionValAry array()
     * @param $data array()
     * @param $dbname string
     * @return int
     *
     */
    public function edit($condition, $conditionValAry, $data, $dbname = 'eby_master_rw'){
        $result = $this->update($condition, $conditionValAry, $data, $this->table, $dbname);
        return $result;
    }

    /**
     * 删除
     * @param $condition string
     * @param $valueAry array()
     * @param $dbname string
     * @return int
     *
     */
    public function del($condition, $valueAry, $dbname = 'eby_master_rw'){
        $result = $this->delete($condition, $valueAry, $this->table, $dbname);
        return $result;
    }

    /**
     * 根据唯一id取得一条记录
     * @return array()
     *
     */
    public function getRowById($id){
        $colum = " * ";
        $sql = "SELECT {$colum} FROM {$this->table}";
        $where = " WHERE ";
        $where .= " `id` = ? ";
        $valueAry = array($id);
        $group = " ";
        $sql .= $where.$group;
        $result = $this->getOne($sql, $valueAry, $dbname = 'eby_master_r');
        return $result;
    }

    /**
     * 查询所有数据
     * @return array()
     *
     */
    public function getAll(){
        $colum = " * ";
        $sql = "SELECT {$colum} FROM {$this->table}";
        $where = " WHERE ";
        $where .= " 1 ";
        $group = " ";
        $sql .= $where.$group;
        $result = $this->query($sql, $valueAry = array(), $dbname = 'eby_master_r');
        return $result;
    }

    /**
     * 条件查询
     * @param $colum string
     * @param $condition string
     * @param $valueAry array()
     * @param $group string
     * @param $order string
     * @param $limit string
     * @return array()
     *
     */
    public function getAllByCondition($colum, $condition = "", $valueAry = array(), $group = '', $order = '',$limit = ''){
        $sql = "SELECT {$colum} FROM {$this->table}";
        if( $condition !== '' ){
            $where = " WHERE {$condition} ";
        }else{
            $where = '';
        }
        $sql .= $where.$group.$order.$limit;
        $result = $this->query($sql, $valueAry, $dbname = 'eby_master_r');
        return $result;
    }

    public  function getAllCount(){
        $colum = " COUNT(*) as cnt ";
        $condition = "";
        $valueAry = array();
        $order = " ";
        $limit = " ";
        $result = $this->getAllByCondition($colum, $condition, $valueAry, $group = '', $order, $limit);

        return $result[0]['cnt'];
    }

    public function execSql($sql, $valueAry = array(), $dbname = 'eby_master_r'){
        $result = $this->query($sql, $valueAry, $dbname);
        return $result;
    }

}
