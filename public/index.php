<?php

use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Core\Application;
use App\Models\User;
use Dotenv\Dotenv;

require_once __DIR__."/../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$db_config=[
    'dns'=>$_ENV['DB_DNS'],
    'user'=>$_ENV['DB_USER'],
    'password'=>$_ENV['DB_PASSWORD']
];


$app= new Application(dirname(__DIR__),$db_config);


$app->router->get('/',[SiteController::class,'home']);
$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->post('/contact',[SiteController::class,'index']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);
$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);
$app->router->get('/logout',[AuthController::class,'logout']);
$app->run();