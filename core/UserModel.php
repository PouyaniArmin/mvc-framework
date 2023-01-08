<?php 
namespace App\Core;
abstract class UserModel extends DbModel{
    abstract public function getDisplayName():string;
}