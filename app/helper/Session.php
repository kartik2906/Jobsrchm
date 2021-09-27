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
    public function sessionInit()
    {
        session_start();
    }

    public function getSession($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    public function setSession($key, $value)
    {
        //if (isset($_SESSION[$key])) {
        return $_SESSION[$key] = $value;

        //}
    }

    public function stopSession($key)
    {
        unset($_SESSION[$key]);
    }
    public function destroySession()
    {
        session_destroy();
    }
}
