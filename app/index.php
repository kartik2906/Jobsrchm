<?php

namespace app;

use app\controller\UserController;
use app\ontroller\LoginController;

require_once __DIR__ . '/start.php';



class Bootstrap
{

  public $controller = 'home';
  public $method = 'home';
  public $params = [];

  public function __construct()
  {
    $uri = $_GET['url'];
    $this->parse_uri($uri);
  }

  public function parse_uri($uri)
  {
    $trimUri = rtrim($uri, FILTER_SANITIZE_URL);
    $filterUri = array_filter(explode('/', $trimUri));

    $this->call_controller($filterUri);
  }


  public function call_controller($filterUri)
  {

    empty($filterUri[0]) ?  $filterUri[0] = null : '';

    $class = '\app\\controller\\' . ucfirst($filterUri[0]) . 'Controller';
    if (isset($filterUri[0])) {
      if (class_exists($class)) {
        $this->controller = $filterUri[0];
        unset($filterUri[0]);
        $this->call_method($this->controller, $filterUri);
      } elseif (!class_exists($class)) {
        echo $filterUri[0] . ' does not exist ';
      }
    } else {
      header("location:/Jobsrchm/app/Home/index");
    }
  }

  public function call_method($controller, $method)
  {

    empty($method[1]) ?  $method[1] = null : '';

    $class = '\app\\controller\\' . $controller . 'Controller';
    $classController = new $class();
    if (isset($method[1])) {
      $this->method = $method[1];
      unset($method[1]);
      if (method_exists($classController, $this->method)) {
        //$this->params = $method ?  $method : [];
        call_user_method_array($this->method, $classController, $this->params);
      }
    } else {
      echo 'invalid request';
    }
  }
}

$bootstrap = new Bootstrap();
