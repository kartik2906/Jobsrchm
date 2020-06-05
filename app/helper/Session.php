<?php

namespace app\helper;

class Session
{
  public function __construct()
  {

    if (!isset($_SESSION)) {
      $this->session_init();
    }
  }
  public function session_init()
  {
    //if (!isset($_SESSION)) {
    session_start();
    //}
  }

  public function get_session($key)
  {

    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }
  }

  public function set_session($key, $value)
  {
    //if (isset($_SESSION[$key])) {
    return $_SESSION[$key] = $value;

    //}
  }

  public function stop_session($key)
  {
    unset($_SESSION[$key]);
  }
  public function destroy_session()
  {
    session_destroy();
  }
}
