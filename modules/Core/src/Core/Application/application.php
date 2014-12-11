<?php
namespace Core\Application;


<<<<<<< HEAD
use \Core\Module\model as moduleM;
use \Core\Router\model as router;

=======
use \Core\Module\model as module;
use \Core\Router\model\parseUrl as getRequest;
>>>>>>> 51f5a390237fff6783cd5d3c1b7e880060dabfcc

class application
{        
    static $view;
    static $config;
    static $controller;
    static $action;
    static $params;
    
    public static function setConfig($config)
    {
        self::$config = module\moduleManager::getConfig($config);
        $request = getRequest::parseURL();
       
        self::$controller = $request['controller'];
        self::$action = $request['action'];
<<<<<<< HEAD

=======
        self::$params = $request['params'];
>>>>>>> 51f5a390237fff6783cd5d3c1b7e880060dabfcc
    }

    public static function getConfig()
    {
        return self::$config;
    }


    public static function dispatch()
    {
        $controllerNameClass= '\Application\controllers\\'.self::$controller;
        
        $controller = new $controllerNameClass();
        $actionName = self::$action;
        ob_start();
            $controller->$actionName();
        self::$view=ob_get_contents();
        ob_end_clean();

        self::twoStep($controller->layout);
    }

    public static function twoStep($layout)
    {
        echo self::$view;
        echo $layout;
               
    }    
}
