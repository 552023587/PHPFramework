<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 数据模型实现类
 * @allen 552023587@qq.com http://framework.youth8090,com
 */
namespace System;
abstract class Model {
    
    private $db;
    public function __construct(){      
        $this->db = Dao::connect(get_class($this));              
    }
    public function select(){
        return $this->db->select();
    }
    public function where($where = array()){
        return $this->db->where($where);
    }
    public function insert($parame=array()){
        return $this->db->insert($parame);
    }
    public function update(){
        return $this->db->update($parame=array());
    }
    public function delete(){
        return $this->db->delete();
    }
    
}