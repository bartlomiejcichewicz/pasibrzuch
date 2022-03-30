<?php

namespace Router;
class Router
{
    private $routes = [];

    const CONTROLLERS_PATH = "./controller/";

    private $ignore;
    private $notFound;
    public function __construct()
    {
        $t = new \ReflectionClass('Router\Router');
        $routesPath = (dirname($t->getFileName()) . "/routes.json");
        if (file_exists($routesPath)) {
            $routes = json_decode(file_get_contents($routesPath), true);

            $this->ignore = $routes['ignore'] ?? "";
            $this->notFound = $routes["not_found"] ?? "";

            unset($routes['ignore'], $routes["not_found"]);
            $this->routes = $routes;
        }
    }

    /**
     * @return object
     * @throws \ReflectionException
     */
    public function getControllerObject()
    {
        $url = strtok($_SERVER["REQUEST_URI"], "?");

        $url = str_replace($this->ignore, "", $url);
        $routeDef = $this->findRouteDefinition($url);
        $controllerName = $this->routes[$routeDef] ?? $this->notFound;

        require_once(static::CONTROLLERS_PATH . $controllerName . ".php");
        $controller = new \ReflectionClass($controllerName);
        $vars = [];
        if (strpos($routeDef, "{") !== false) {
            $urlParts = explode("/", $url);
            foreach (explode("/", $routeDef) as $index => $part) {
                if (strpos($part, "{") !== false) {
                    $vars[] = $urlParts[$index];
                }
            }
        }
        $controller = $controller->newInstanceArgs($vars);
        return $controller;
    }

    private function findRouteDefinition($url)
    {
        foreach ($this->routes as $routeDef => $conf) {
            $routeRegex = "#^" . preg_replace(["#\{.*\}#", "#\/#"], [".+", "\/"], $routeDef) . "$#";
            if (strlen($url) > 1) {
                $url = rtrim($url, "/");
            }
            if (preg_match($routeRegex, $url)) {
                return $routeDef;
            }
        }
    }

}