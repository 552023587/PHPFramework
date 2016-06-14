<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 主控制器类
 * @allen 552023587@qq.com http://framework.youth8090,com
 */
namespace System;
abstract class Controller{
    private $route;
    public function __construct() {
        $this->route = Route::getConfig();
    }
    public function render($view = null,$data=null){
         if(isset($view))
         {
           $template = new View($this->route["module"]."/".$view,$data);  
         }
         else
         {
           $template = new View($this->route["module"]."/".$this->route["controller"]."/".$this->route["method"],$data);   
         }
         $template->Complate();
  }
  public function loadConfig(){
      
  }
  public function isPost(){
      if($_SERVER["REQUEST_METHOD"]=="POST")
     {
         return true;
     }
  }
  public function isGet(){
     if($_SERVER["REQUEST_METHOD"]=="GET")
     {
         return true;
     }
  }
  public function loadModel($Models){
      
      $file  = __APP__.$this->route["module"]."/Model/".$Models.".php";
      if(file_exists($file))
      {
         require $file;  
         $Models = $this->route["module"]."\Model\\$Models"; 
         $newModel = new $Models();
         return $newModel;
      }
      else
      {
          throw  new \Exception("数据模型不存在");
      }
  }
  public function post(){
      return addslashes($_POST);
  }
  public function get($value=null){
      if($value!=null)
      {
         return $this->route["parameter"][$value];  
      }
      else
      {
         return $this->route["parameter"];  
      }
  }
  
  
}
