<?php
namespace App\core;
/**
 * Class Router
 */
class Router
{
    protected array $routes=[];
    protected Request $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }
    public function get($path,$callback){
        $this->routes['get'][$path]=$callback;
    }
    public function post($path,$callback){
        $this->routes['post'][$path]=$callback;
    }

    public function resolve(){
       $path=$this->request->path();
        $method=$this->request->method();
        $callback=$this->routes[$method][$path] ?? false;
        if ($callback === false) {
            return "not Found";
            exit;
        }
        if (is_string($callback)) {
           return $this->renderView($callback);
    }
        return call_user_func($callback);
    }
    public function renderView($view){
        $laycontent=$this->layoutContent();
        include_once "../views/$view.php";        
    }
    protected function layoutContent(){
        include_once __DIR__."../views/layouts/main.php";
    }
}
