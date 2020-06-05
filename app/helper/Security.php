<?php

namespace app\helper;

use app\helper\Session;

class Security
{
  public $session;
  public function __construct()
  {
    $this->session = new Session();
    //$this->session->session_init();
  }

  public function csrf_token()
  {
    $token = md5(uniqid(rand(), TRUE));
    return  $this->session->set_session('csrf', $token);
    // $token = $_SESSION['csrf'];
    // return $token;
  }

  public function token_check($token)
  {
    if ($token === $this->session->get_session('csrf')) {
      unset($_SESSION['csrf']);
      return true;
    }
    return false;
  }

  public function emailToken()
  {
    $token = md5(uniqid(rand(), TRUE));
    return $token;
  }
}
