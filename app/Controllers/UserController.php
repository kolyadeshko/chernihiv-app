<?php


namespace App\Controllers;


use App\Controller;
use App\Session;
use App\Validators\UserValidator;

class UserController extends Controller
{
    public function userRegister()
    {

        $serverErrors = $this->getServerErrors();
        return $this->renderer->render(
            $this->request,
            "user-register",
            [
                "serverErrors" => $serverErrors
            ]
        );
    }

    private function getServerErrors()
    {
        return $this->session->getSessionByKey(
            'serverErrors',
            Session::$UNSET_AFTER_GET_KEY
        );

    }

    public function checkUser()
    {
        $getParams = $this->request->getGetParams();
        $field = key($getParams);
        $value = $getParams[$field];
        $res = $this->models['users']->getByField($field, $value);
        if (!empty($res)) return "+";
        return "-";
    }

    public function registerDataProcessing()
    {
        $registerData = $this->request->getPostParams();
        if (empty($registerData)) return header("Location:/");
        $validator = new UserValidator(
            $registerData,
            $this->models['users']
        );
        if (!($validator->isValid())) {
            $errorList = $validator->getErrorList();
            $this->session->setSessionKey(
                "serverErrors",
                $errorList
            );
            return header("Location:/register");
        }
        $registerData['password'] = $this->getHashPassword(
            $registerData['password']
        );
        $this->models['users']->registerUser($registerData);
        $this->session->setSessionKey(
            "successRegister",
            $registerData
        );
        return header("Location:/register-answer");
    }

    public function registerAnswer()
    {
        $answer = $this->session->getSessionByKey(
            "successRegister",
            Session::$UNSET_AFTER_GET_KEY
        );
        if (!$answer) header("Location:/");
        return $this->renderer->render(
            $this->request,
            "register-answer",
            [
                'answer' => $answer
            ]
        );

    }

    private function getHashPassword($password)
    {
        return md5($password);
    }

    public function checkLogin()
    {
        sleep(2);
        $data = $this->request->getGetParams();
        $checkNickname = $this->models['users']->getByField("nickname", $data['nickname']);
        if (empty($checkNickname)) {
            return "Пользователь с таким ником не зарегестрирован";
        }
        $user = $checkNickname[0];
        if (!$this->checkPassword($data['password'], $user['password'])) {
            return 'Неверный пароль!';
        }
        return "valid";

    }

    private function checkPassword($password, $hashPassword)
    {
        if ($this->getHashPassword($password) === $hashPassword) {
            return true;
        }
        return false;
    }

    public function loginForm()
    {

        return $this->renderer->render(
            $this->request,
            "login-form",
            [
                "errors" => false,
                "rememberedUser" => $this -> session -> getRememberedUser()
            ]
        );
    }

    public function loginDataProcessing()
    {
        $nickname = $this->request->getPostParams()['nickname'];
        if (!isset($nickname)) {
            return header("Location:/login");
        }
        // запоминаем пользователя
        $rememberMe = $this -> request -> getPostParams()['remember-me'];
        if ($rememberMe) $this -> session -> rememberUser($nickname);

        $user = $this->models['users']->getUserByNickname($nickname);
        $this->session->setSessionKey(
            "authUser",
            $user
        );
        return header("Location:/");
    }

    public function headerUserInformation()
    {
        $auth = $this -> request -> auth;
        $res =
            [
                "isAuth" => $auth -> isAuth(),
                "userdata" =>
                [
                    "id" => $auth -> getUserData()['id'],
                    "nickname" => $auth -> getUserData()['nickname']
                ]
            ];
        return json_encode($res);
    }

    public function logout(){
        $this -> request -> auth -> logoutUser();
        return header("Location:/");
    }

}