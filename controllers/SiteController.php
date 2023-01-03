<?php
 namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\core\Request;

 class SiteController extends Controller{
    public function home(){
        $params=['name'=>'Armin'];
        return $this->render('home',$params);
    }
    public function contact(){
        return $this->render('contact');
    }
    public function index(Request $request){
        $body=$request->body();
        var_dump($body);
        return $this->render('contact');
    }
 }