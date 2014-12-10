<?php

/**
 * Return modules merge configuration
 * 
 * @param string $configfile
 */
class Core_src_Module_model_moduleManager
{
    public static $config;
    
    private static function loadConfig($configFile)
    {
        include ($configFile);
        foreach ($config['modules'] as $module)
        {
            $globalConfig=array();
            $localConfig=array();
    
            $globalfile = __DIR__.'/../../../../../config/autoload/'
                .strtolower($module).'.global.php';
            if(file_exists($globalfile))
            {
                include ($globalfile);
                $globalConfig = $config;
            }
    
            $localfile = __DIR__.'/../../../../../config/autoload/'
                .strtolower($module).'.local.php';
            if(file_exists($localfile))
            {
                include ($localfile);
                $localConfig = $config;
            }
            $config = array_replace_recursive($globalConfig,$localConfig);
        }
        self::$config = $config;
    }
    
    public static function getConfig($configFile)
    {
        if (isset(self::$config)){
            return self::$config;
        }   else {
            self::loadConfig($configFile);
            return self::$config;
        }
    }
    
}

