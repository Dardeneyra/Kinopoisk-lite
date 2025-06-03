<?php

namespace App\Kernel\Router;

use App\Kernel\Controller\Controller;
use App\Kernel\View\View;

class Router
{
    public $initRoutes;
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function initRoutes(): void
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    public function __construct(
        private View $view
    )
    {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (!$route) {
            $this->notFound();
            return;
        }

        if (is_array($route->getAction())) {
        [$controller, $action] = $route->getAction();
        /** @var Controller $controller */
        $controller = new $controller();

        call_user_func([$controller, 'setView'], $this->view);
        call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }

    private function notFound(): void
    {
        echo "404 Not Found";
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }

    private function getRoutes(): array
    {
        return require __DIR__ . '/../../config/routes.php';
    }
}
