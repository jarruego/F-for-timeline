<?php
require_once '../autoload.php';

<<<<<<< HEAD
// set_include_path(get_include_path().";".__DIR__.'/../modules'.
//     ";".__DIR__.'/../vendor');

// use \Core\Application\application as bootstrap;

$application = new \Core\Application\application('../config/global.php');
$application->run();
=======
// if(isset($_SERVER['APPLICATION_ENV']))
//     if ($_SERVER['APPLICATION_ENV'] == 'development') {
//         error_reporting(E_ALL & ~E_STRICT);
//         ini_set("display_errors", 1);
//     }

// set_include_path(get_include_path().";".__DIR__.'/../modules'.
//     ";".__DIR__.'/../vendor');

// use \Core\Application\application as bootstrap;

// $application = new \Core\Application\application('../config/global.php');
// $application->run();

\Core\Application\application::setConfig('../config/global.php');
\Core\Application\application::dispatch();
>>>>>>> 04d8d5d7c250678a4e751244ac7334cb3fec1d3a

