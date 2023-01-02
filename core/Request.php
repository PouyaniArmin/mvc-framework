<?php 
namespace App\core;

class Request{
    public function path(){
        $path=$_SERVER['REQUEST_URI'] ?? "/";
        $position=strpos($path,"?");
        if($position===false){
            return $path;
        }
        return substr($path,0,$position);

    }
    public function method(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}