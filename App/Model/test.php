<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 用户模型
 */
namespace Home\Model;
use System\Model;
class test extends Model{
    public function show(){
           echo "调用了模型SHOW方法";
    }
}