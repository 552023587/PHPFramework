<?php
/**
 * 这是一个栗子
 */
namespace Home\Controller;
use System\Controller;
class Index extends Controller{
 public function Index(){
    //加载一个用户数据模型
    //$lists = $this->loadModel("user")->select();
    if($this->isPost())
    {
        echo "post";
    }
    if($this->isGet())
    {
        echo "get";
    }
    $this->render();
 }
 public  function excel(){
    
 }
}