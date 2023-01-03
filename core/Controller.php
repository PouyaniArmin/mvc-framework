<?php 
namespace App\Core;

class Controller{
    public $layout='main';
    public function setLayout(string $layout){
        $this->layout=$layout;
    }
    public function render($view,$params=[]){
        return Application::$app->router->renderView($view,$params);
    }
}