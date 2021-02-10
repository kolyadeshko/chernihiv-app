<?php


namespace App\Validators;


use App\Models\MySqlModel;
use App\Models\Users;

class UserValidator
{
    private $nickname,$email,$password;
    private $errors = [];
    private $model;


    public function __construct($data,MySqlModel $model)
    {
        $this -> nickname = $data['nickname'];
        $this -> email = $data['email'];
        $this -> password = $data['password'];
        $this -> model = $model;
    }

    private function validateNickName(){
        if (strlen($this -> nickname) < 5){
            $this -> addError("Ник должен быть не меньше 5-ти символов");
            return;
        }
        if (!preg_match("/^[A-Za-z_0-9]+$/",$this -> nickname)){
            $this -> addError(
                "Ваш ник должен содержать только буквы латинского алфавита" .
                ",цифры или знак нижнего подчеркивания"
            );
            return;
        }
        $nicknameInDB = $this -> model -> getByField(
            'nickname',
            $this -> nickname
        );
        if (!empty($nicknameInDB)){
            $this -> addError("Ник {$this->nickname} уже занят");
            return;
        }
    }

    private function validateEmail(){
        $regEmail = "/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/";
        if (!preg_match($regEmail,$this -> email)){
            $this -> addError(
                "Введен некорректный адрес электронной почты." .
                "Email должен быть по типу 'login.3@i.ru' или '123456@ru.name.ru' "
            );
            return;
        }
        $emailInDB = $this -> model -> getByField(
            'email',
            $this -> email
        );
        if (!empty($emailInDB)){
            $this -> addError("Email {$this->email} уже занят");
            return;
        }
    }

    private function validatePassword(){
        if (strlen($this -> password) < 5){
            $this -> addError("Пароль должен быть не меньше 5-ти символов");
            return;
        }
        if (!preg_match("/^[A-Za-z0-9]+$/",$this -> password)){
            $this -> addError(
                "Пароль должен содержать только буквы латинского алфавита и цифры"
            );
            return;
        }
        if (!preg_match("/[A-Z]/",$this -> password)){
            $this -> addError(
                "Пароль должен иметь минимум один заглавный символ"
            );
            return;
        }
        if (!preg_match("/[0-9]/",$this -> password)){
            $this -> addError(
                "Пароль должен иметь минимум одну цифру"
            );
            return;
        }
    }

    public function isValid(){
        $this -> validateNickName();
        $this -> validateEmail();
        $this -> validatePassword();
        if (empty($this -> errors)) return true;
        return false;
    }

    public function getErrorList(){
        return $this -> errors;
    }

    private function addError($message){
        array_push($this -> errors,$message);
    }
}