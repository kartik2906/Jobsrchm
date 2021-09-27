<?php

namespace app\helper;

use app\helper\Session;

class Security
{
    public $session;
    public function __construct()
    {
        // $this->session = new Session();
    //$this->session->session_init();
    }


    public function csrfToken()
    {
        $this->session = new Session();
        $token = md5(uniqid(rand(), true));
        return  $this->session->setSession('csrf', $token);
        // $token = $_SESSION['csrf'];
    // return $token;
    }

    public function tokenCheck($token)
    {
        $this->session = new Session();
        if ($token === $this->session->getSession('csrf')) {
            unset($_SESSION['csrf']);
            return true;
        }
        return false;
    }

    public function emailToken()
    {
        $token = md5(uniqid(rand(), true));
        return $token;
    }
}
