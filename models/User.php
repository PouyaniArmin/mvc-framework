<?php 
namespace App\Models;

use App\Core\DbModel;
use App\Core\Model;

class User extends DbModel{
    const STATUS_INACTIVE=0;
    const STATUS_ACTIVE=1;
    const STATUS_DELETED=2;
    
    public string $firstname='';
    public string $lastname='';
    public string $email='';
    public int $status=self::STATUS_INACTIVE;
    public string $password='';
    public string $confirmPassword='';

    public function save(){
        $this->status=self::STATUS_INACTIVE;
        $this->password=password_hash($this->password,PASSWORD_DEFAULT);
        return parent::save();
    }
    //Model class functions
    public function rules(): array
    {
        return [
            'firstname'=>[self::RULE_REQUIRED],
            'lastname'=>[self::RULE_REQUIRED],
            'email'=>[self::RULE_REQUIRED,self::RULE_EMAIL,
            [self::RULE_UNIQUE,'class'=>self::class
            ]],
            'password'=>[self::RULE_REQUIRED,[self::RULE_MIN,'min'=>6],[self::RULE_MAX,'max'=>16]],
            'confirmPassword'=>[self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']]
        ];
    }
    // dbModel class functions 
    public function tableName():string{
        return "users";
    }
    public function attributes():array
    {
        return['firstname','lastname','email','status','password'];
    }
    public function labels(): array
    {
        return [
            'firstname'=>'First Name',
            'lastname'=>'Last Name',
            'email'=>'Email',
            'password'=>'Password',
            'confirmPassword'=>'Confirm password'
        ];
    }
    
}