<?php

namespace App\Core;

use App\Core\Middlewares\BaseMiddleware;

class Controller
{
    public $layout = 'main';
    public $action = '';

    protected array $middleware = [];
    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }
    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function regisetrMiddleware(BaseMiddleware $middleware)
    {
        $this->middleware[] = $middleware;
    }
    public function getMiddleware(): array
    {
        return $this->middleware;
    }
}
