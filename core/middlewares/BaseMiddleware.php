<?php 

namespace App\Core\Middlewares;

abstract class BaseMiddleware{
    abstract public function execute();
}