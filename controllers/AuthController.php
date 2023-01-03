<?php 
namespace App\Controllers;

use App\Core\Controller;
use App\core\Request;

class AuthController extends Controller{
    public function login(Request $request){
        $this->setLayout('auth');
        return $this->render('login');
    }
    public function register(Request $request){
        if($request->isPost()){
            return "handle submitted data";
        }
        $this->setLayout('auth');
        return $this->render('register');
    }
}