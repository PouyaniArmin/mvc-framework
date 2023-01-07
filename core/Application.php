<?php

namespace App\Core;

use App\core\Request;
use App\core\Router;

/**
 * class Application
 * @author Armin Pouyani <pouyaniarmin@gmail.com>
 */

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public static Application $app;
    public Controller $controller;
    public function __construct($rootPath,array $db_config)
    {
        self::$ROOT_DIR=$rootPath;
        self::$app=$this;
        $this->request=new Request;
        $this->response=new Response;
        $this->session=new Session();
        $this->router=new Router($this->request,$this->response);
        $this->db=new Database($db_config);
    }

    public function getController():Controller{
        return $this->controller;
    }
    public function seController(Controller $controller){
        $this->controller=$controller;
    }

    public function run(){
       echo $this->router->resolve();
    }
}
