<?php

namespace app\controller;

use app\base\Controller as BaseController;
use app\model\Dashboard;
use app\helper\Session;




class DashboardController extends BaseController
{
  public $session;
  public function __construct()
  {
    $this->session = new Session();
    //$this->session->session_init();
  }


  public function userDashboard()
  {

    !isset($_SESSION['jobs']) ? $_SESSION['jobs'] =  []  : $_SESSION['jobs'];
    $dashboard = new Dashboard();

    $result = $dashboard->applied_job_user();


    $this->render('dashboard', ['result' => $result]);
  }
}
