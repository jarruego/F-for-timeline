<?php
require_once '../autoload.php';


$application = new \Core\Application\application('../config/global.php');
$application->run();


\Core\Application\application::setConfig('../config/global.php');
\Core\Application\application::dispatch();
