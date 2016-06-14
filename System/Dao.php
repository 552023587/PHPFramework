<?php

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
    private static $config;
    private static $db;
    private $where = null;
    private static $_instance;
    private static $model;
    private function __construct(){}
    public function __clone() {}
    public static function connect($model){
        global $config;
        self::$config = $config['db'];
        self::$model = explode('\\',$model)[2];
        try {
        self::$db = new \PDO(self::$config['type'].":host=".self::$config['host'].";dbname=".self::$config['dbname'],self::$config['name'],self::$config['pwd'],array(\PDO::ATTR_PERSISTENT => true)); 
        self::$db->query('set names utf8;');
        }catch (Exception $e) {
           die('Connection failed:'. $e->getMessage()); 
        }
        if(!(self::$_instance instanceof self)){         
               self::$_instance = new Dao();
        }
        return self::$_instance;
    }
    public function select(){  
          
          if($this->where==null)
          {
             $res = self::$db->query("select * from ".self::$model);  
          }
          else
          {
             $res = self::$db->query("select * from ".self::$model."  where  ".$this->where); 
          }
          $arr =array();
          while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
             $arr[]=$row;       
          }
          $this->where = null;
          self::$db = null;
          return $arr;
    }
    public function where($where = array()){
        $where = $this->format($where);
        for($i=0;$i<count($where['val']);$i++)
        {
            if(count($where['val'])>1)
            {
             $this->where[]=$where['key'][$i]."=".$where['val'][$i];   
            }
            else
            {
             $this->where[]=$where['key'][$i]."=".$where['val'][$i]; 
            }
        }
        $this->where = implode(",",$this->where);
        if($this->where!=null)
        {
           return $this;   
        }
    }
    public function insert($parame=array()){
        $parame = $this->format($parame);
        $count = self::$db->exec("insert into  ".self::$model."(".implode(',',$parame['key']).")value(".implode(',',$parame['val']).")");
        self::$db = null;
        return $count;
    }
    public function update($parame=array()){
        $parame = $this->format($parame);
        for($i=0;$i<count($parame['val']);$i++)
        {
            if(count($parame['val'])>1)
            {
             $p[]=$parame['key'][$i]."=".$parame['val'][$i];   
            }
            else
            {
             $p[]=$parame['key'][$i]."=".$parame['val'][$i]; 
            }
        }
        $p = implode(",",$p);
        if($this->where==null){return FALSE;}
        $count = self::$db->exec("update".self::$model." set $p where ".$this->where);
        self::$db = null;
        $this->where = null;
        return $count;
    }
    private function format($parame =array()){
         foreach($parame as $k=>$v)
        {
           $key[] = $k;          
           switch (gettype($v))
           {
              case "string": $val[] = "'".$v."'";
              break;
              case "integer":$val[] = $v; 
              break;
           }      
        }            
        $p = array(
            "key"=>$key,
            "val"=>$val
        );
        return $p;
    }
    public function delete(){
          if($this->where==null)
          {
             $count = self::$db->exec("delete from ".self::$model); 
          }
          else
          {
            $count = self::$db->exec("delete from ".self::$model." where ".$this->where); 
          }
          $this->where = null;
          self::$db = null;
          return $count;
    }
}
