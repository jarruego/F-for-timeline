<?php
require_once '../autoload.php';

<<<<<<< HEAD

$application = new \Core\Application\application('../config/global.php');
$application->run();


\Core\Application\application::setConfig('../config/global.php');
\Core\Application\application::dispatch();
=======
if(isset($_SERVER['APPLICATION_ENV']))
    if ($_SERVER['APPLICATION_ENV'] == 'development') {
        error_reporting(E_ALL & ~E_STRICT);
        ini_set("display_errors", 1);
    }

set_include_path(get_include_path().
            ";".__DIR__.'/../modules'.
            ";".__DIR__.'/../vendor');

\Core\Application\application::setConfig('../config/global.php');
\Core\Application\application::dispatch();


>>>>>>> 51f5a390237fff6783cd5d3c1b7e880060dabfcc
