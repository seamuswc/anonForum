<?php

class Router
{
    protected $routes = [
      'GET' => [],
      'POST' => []
    ];

  public static function load($file) {
    $router = new self;
    require $file;
    return $router;
  }

  public function getall() {
    return $this->routes;
  }

    public function get($uri, $controller) {
      $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
      $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
          return $this->callControllerFunction(
            ...explode('@', $this->routes[$requestType][$uri])
          );
        } else {
          return $this->callControllerFunction('pagesController','index');
        }

    }

    protected function callControllerFunction($controller, $action) {

      $controller = new $controller;

      if (! method_exists($controller, $action)) {
        return (new pagesController)->index();
      }

      return $controller->$action();
    }

}
