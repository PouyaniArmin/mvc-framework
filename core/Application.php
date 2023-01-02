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
    public Router $router;
    public Request $request;
    public function __construct()
    {
        $this->request=new Request;
        $this->router=new Router($this->request);
    }

    public function run(){
       echo $this->router->resolve();
    }
}
