<?php 
namespace App\Controllers;

use App\Core\Controller;
use App\core\Request;
use App\Models\RegisterModel;

class AuthController extends Controller{
    public function login(Request $request){
        $this->setLayout('auth');
        return $this->render('login');
    }
    public function register(Request $request){
        $registerModel=new RegisterModel();
        if($request->isPost()){
            $registerModel->loadData($request->body());
            if ($registerModel->validate() && $registerModel->register()) {
                return 'success';
            }
            return $this->render('register',['model'=>$registerModel]);
        }
        $this->setLayout('auth');
        return $this->render('register',['model'=>$registerModel]);
    }
}