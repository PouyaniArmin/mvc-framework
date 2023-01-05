<?php 

use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Core\Application;
use Dotenv\Dotenv;

require_once __DIR__."/vendor/autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db_config=[
    'dns'=>$_ENV['DB_DNS'],
    'user'=>$_ENV['DB_USER'],
    'password'=>$_ENV['DB_PASSWORD']
];
$app= new Application(__DIR__,$db_config);
$app->db->applyMigrations();