<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 简单路由类
 * @allen 552023587@qq.com http://framework.youth8090,com
 */
namespace System;
class Route {
    public static function load(){
        $config = self::getConfig();
        $module = $config["module"];
        $controllers =  $config["controller"];
        $method  =  $config["method"];
        $Class =  __APP__."Controller/".$module."/".$controllers.".php";
        if(!is_dir(__APP__.$module))
        {
             throw  new \Exception("模块不存在");  
        }
        if(file_exists($Class))
        {
           require $Class;
           $controllers = "Controller\\$module\\$controllers";
           $obj = new $controllers();
           if(!method_exists($obj,$method))
           {
                throw  new \Exception("方法不存在");  
           }
           $obj->$method();
        }
        else
        {
              throw new \Exception("控制器不存在");
        }
    }
    private static function checkUrl($url){    
        $url=="m=".__DEFAULT_MODULE__?$url = $url."&c=index&a=index":"";  
        $url==""?$url = "m=".__DEFAULT_MODULE__."&c=index&a=index":"";
        return $url;
    }
    public  static function getConfig(){
        $query_string = self::checkUrl($_SERVER["QUERY_STRING"]);
        $query  =  explode("&", $query_string);
        $module = preg_replace("/^[m,M]=/","",$query[0]);
        $controller = preg_replace("/^[c,C]=/","",$query[1]);
        $method  = preg_replace("/^[a,A]=/","",$query[2]); 
        $parameter = array();
        if(count($query)>3)
        {
            for($i=3;$i<count($query);$i++)
            {
            $arr = explode("=",$query[$i]);
            $parameter[$arr[0]] = addslashes($arr[1]); 
            } 
        }
        return $config = array(
            "module"=>$module,
            "controller"=>$controller,
            "method"=>$method,
            "parameter"=>$parameter
        );
    }
}
