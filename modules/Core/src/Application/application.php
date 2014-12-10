<?php
// namespace Core\Application;


class Core_src_Application_application
{
    public $controller;
    public $action;
    private $view;

    static $config;

    public function __construct($config)
    {

        include_once '../modules/Core/src/Router/model/parseUrl.php';             
        
        self::$config = Core_src_Module_model_moduleManager::getConfig($config);

        $request = Core_src_Router_model_parseUrl::parseURL();
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
        $controllerNameClass = 'Application_src_Application_controllers_'.
            $this->controller;


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
