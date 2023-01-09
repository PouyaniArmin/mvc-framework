<?php 
namespace App\Core\Exception;

use Exception;

class ForbiddenException extends Exception{
    protected $message='You don\'t have permisstion to access this page '; 
    protected $code=403;


}