<?php
namespace Core\Application;

<<<<<<< HEAD
use \Core\Module\model as moduleM;
use \Core\Router\model as router;

class application
{
    public $controller;
    public $action;
    private $view;

    static $config;

    public function __construct($config)
    {

        //include_once '../modules/Core/src/Router/model/parseUrl.php';
       // include_once '../modules/Core/src/Module/model/moduleManager.php';
              
        
        //self::$config = moduleManager($config);

        //$request = parseURL();
        
        
        self::$config = moduleM\moduleManager::getConfig($config);
        
        $request = router\parseUrl::parseURL();
        
        echo "<pre>Request: ";
        print_r($config);
        echo "</pre>";

        $this->controller = $request['controller'];
        $this->action = $request['action'];


=======
class application
{        
    static $view;
    static $config;
    static $controller;
    static $action;  
    
    public static function setConfig($config)
    {
        include_once '../modules/Core/src/Router/model/parseUrl.php';
        include_once '../modules/Core/src/Module/model/moduleManager.php';
        self::$config = moduleManager($config);  
        $request = parseURL();
        self::$controller = $request['controller'];
        self::$action = $request['action'];
>>>>>>> 04d8d5d7c250678a4e751244ac7334cb3fec1d3a
    }

    public static function getConfig()
    {
        return self::$config;
    }

<<<<<<< HEAD
    public function run()
    {
//         $controllerNameClass = 'Application_src_Application_controllers_'.
//             $this->controller;
        $controllerNameClass= '\Application\controllers\\'.$this->controller;
        
        $controller = new $controllerNameClass();
        $actionName = $this->action;
        ob_start();
            $controller->$actionName();
        $this->view=ob_get_contents();
        ob_end_clean();


    }

    public function __destruct()
    {
        echo $this->view;
        //include ('../modules/Application/src/Application/layouts/'.$this->controller->layout);
    }
=======
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
  
>>>>>>> 04d8d5d7c250678a4e751244ac7334cb3fec1d3a
}
