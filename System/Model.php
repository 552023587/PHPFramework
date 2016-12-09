<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 数据模型实现类
 * @allen 552023587@qq.com http://framework.youth8090,com
 */
namespace System;
use System\Dao;
abstract class Model {
    
    public static function Instance(){
        $child  = new \ReflectionClass(get_class(self));
        return  new Dao($child::db_table);              
    }
    
}