<?php
namespace Core\Application;

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


    }

    public static function getConfig()
    {
        return self::$config;
    }

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
}
