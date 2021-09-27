<?php

namespace app\controller;

use app\base\Controller as BaseController;
use app\model\User;
use app\helper\Validation;
use app\helper\Session;

class LoginController extends BaseController
{
    public $session;

    public function loginForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => $_REQUEST['username'],
                'password' => $_REQUEST['password']
             ];
            $validator = new Validation();
            $users = new User();

            foreach ($data as $key => $value) {
                if ($key == 'username') {
                    $validator->add_error_field($key);
                }
                if ($key == 'password') {
                    $validator->add_error_field($key);
                }
            }
            
            $this->sanitize_value($data);

            if (!$validator->pass()) {
                $users->loginUser($data['username'], $data['password']);
            }
        }

        $this->render('login', ['validator' => !isset($validator) ? $validator = new Validation() : $validator]);
    }
    public function Logout()
    {
        $session = true;
        $this->session = new Session();
        $this->session->stopSession('loggedin');
        // $this->session->destroy_session();

        $this->session->stopSession('userid');
        $this->session->stopSession('firstname');
        $this->session->stopSession('lastname');
        $this->session->stopSession('username');




        header("location:/app/public/Home/index");
    }
}
