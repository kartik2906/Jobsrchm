<?php

namespace helper;

class Session
{
  public function session_init()
  {
    session_start();
  }

  public function get_session($key)
  {

    if (isset($_SESSION[$key])) {
      return $key;
    }
  }

  public function set_session($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public function stop_session($key)
  {
    unset($_SESSION[$key]);
  }
}
