<?php

namespace app\controller;

use app\model\User;
use app\helper\Session;
use app\config\Database;
use app\helper\Security;


use app\helper\Validation;
use app\base\Controller as BaseController;

require_once("../helper/help.php");
class RegisterController extends BaseController
{
    public $session;
    /**
     * Register user controller
     * @route /Register/registerForm
     */
    public function registerForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'firstname' => $_REQUEST['firstname'],
                'lastname' => $_REQUEST['lastname'],
                'email' => $_REQUEST['email'],
                'username' => $_REQUEST['username'],
                'password' => $_REQUEST['password'],
                'roleid' => $_REQUEST['roleid'],
                'token' => $_REQUEST['token'],
                'register' => $_REQUEST['Register']
             ];
        }
        $this->session = new Session();
        $validator = new Validation();
        $users = new User();
        $validator->register_validation($data);
        $this->sanitize_value($data);
        $security = new Security();
        if (isset($data['register'])) {
            if (!$validator->pass() && $data['token'] === $this->session->getSession('csrf')) {
                // $users->reg_user($data['firstname'], $data['lastname'], $data['email'], $data['username'], $data['password'], $data['roleid']);
                $users->regUser($data);
            }
        }

        $this->render('register', [
      'validator' => !isset($validator) ? $validator = new Validation() : $validator, 'tokens' => !isset($security) ? $security = new Security() : $security,
      'error' => !isset($users) ? $users = new User() : $users
    ]);
    }

    /**
     * Verify email and token from  url which is passed in into params of url
     */

    public function emailVerified()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $email = $_REQUEST['email'];
            $token = $_REQUEST['token'];
            $users = new User();
        }
        if ($users->checkTokenEmail($email, $token) < 1) {
            $users->verified($email);
        } else {
            return false;
        }


        $this->render('verifyemail');
    }
}
