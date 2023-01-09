<?php
 namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\core\Request;
use App\Core\Response;
use App\Models\ContactForm;

 class SiteController extends Controller{
    public function home(){
        $params=['name'=>'Armin'];
        return $this->render('home',$params);
    }
    public function contact(Request $request,Response $response){
        $contact=new ContactForm;
        if ($request->isPost()) {
            $contact->loadData($request->body());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success','Thanks for contacing us');
                return $response->redirect('contact');
            }

        }
        return $this->render('contact',['model'=>$contact]);
    }
 }