<?php

namespace App\Core;

use App\core\Request;
use App\core\Router;
use App\Models\User;
use Exception;

/**
 * class Application
 * @author Armin Pouyani <pouyaniarmin@gmail.com>
 */

class Application
{
    public static string $ROOT_DIR;

    public string $layout='main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public static Application $app;
    public ?Controller $controller=null;
    public ?DbModel $user;
    public View $view;

    public function __construct($rootPath, array $db_config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request;
        $this->response = new Response;
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($db_config);
        $this->view=new View;
        $this->user = new User;

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->user->primaryKey();
            $this->user = $this->user->findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user=null;   
        }
    }

    public function getController(): Controller
    {
        return $this->controller;
    }
    public function seController(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest(){
        return !self::$app->user;
    }

    public function run()
    {
        try {
        echo $this->router->resolve();
        } catch (Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error',[
                'exception'=>$e
            ]);
        }
    }
}
