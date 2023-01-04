<?php 
namespace App\Models;

use App\Core\Model;

class RegisterModel extends Model{
    public string $firstname='';
    public string $lastname='';
    public string $email='';
    public string $password='';
    public string $confirmPassword='';

    public function register(){
        return "register";
    }
    public function rules(): array
    {
        return [
            'firstname'=>[self::RULE_REQUIRED],
            'lastname'=>[self::RULE_REQUIRED],
            'email'=>[self::RULE_REQUIRED,self::RULE_EMAIL],
            'password'=>[self::RULE_REQUIRED,[self::RULE_MIN,'min'=>6],[self::RULE_MAX,'max'=>16]],
            'confirmPassword'=>[self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']]
        ];
    }
}