<?php 
namespace App\Core;

class View{
    public  string $title='';

    public function renderView($view, $parmas = [])
    {

        $viewContent = $this->renderOnlyView($view, $parmas);
        $layoutContent = $this->layoutContent();
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }
    protected function layoutContent()
    {

        $layout = Application::$app->layout;
        if (Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }
    protected function renderOnlyView($view, $parmas)
    {
        foreach ($parmas as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}