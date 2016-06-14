<?php
/**
 * 入口启动
 * @allen 552023587@qq.com http://framework.youth8090,com
 */
namespace System;
class App{
	private static $_instance;
        private  $route;
        private function __construct(){}
	public  function __clone(){}
	public static function getInstance(){
		if(!(self::$_instance instanceof self))
		{
		   self::$_instance = new App();
		}
		return self::$_instance;          
	}
	public function run(){        
            Route::load();
	}
       public function debug() {
        Global $config;
        if ($config['debug']) {
            ini_set("display_errors", "On");
            error_reporting(E_ALL | E_STRICT);
        } else {
            ini_set("display_errors", "Off");
        }
    }

}
				