<?php
Class UserModel extends CommonModel{

    public function __construct(){
        parent::__construct();
        $this->table = 'eby_user';

    }

}
