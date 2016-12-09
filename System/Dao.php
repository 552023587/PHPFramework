F<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dao
 *
 * @author 552023587@qq.com
 */
namespace System;
class Dao{
    //put your code here
    private  $db;
    private  $model;
    private  $select;
    private  $where  = [];
    private  $param  = [];
    public function __construct($model){
        try{
            $this->model = $model;    
            $this->db = new \PDO(__CONFIG__['type'].":host=".__CONFIG__['host'].";dbname=".__CONFIG__['dbname'],__CONFIG__['name'],__CONFIG__['pwd'],array(\PDO::ATTR_PERSISTENT => true)); 
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e) {
            throw new Exception('Connection failed:'. $e->getMessage()); 
        }
    }
    public function select($select){  
        $this->select = $select;
    }
    public function where(){
          
    }
    public function insert(){
       
    }
    public function update(){
     
    }
    private function format(){
      
    }
    public function delete(){
         
    }
    public function find(){
        
    }
    public function findAll(){
        
    }
    public function bindParam(){
        
    }
}
