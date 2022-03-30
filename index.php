<?php
require_once("./bootstrap.php");
require_once("./router/router.php");
$router = new Router\Router();
$router->getControllerObject()->Run();
