<?php

namespace app\controller;

use app\base\Controller as BaseController;
use app\model\Recruiter;
use app\helper\Validation;
use app\model\User;
use app\helper\Session;




class HomeController extends BaseController
{
  public $session;
  public function __construct()
  {
    $this->session = new Session();
    //$this->session->session_init();
  }


  public function index()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

      $search = !isset($_REQUEST['search']) ?   $_REQUEST['search'] = '' : $_REQUEST['search'];
      $search =  $this->sanitize_single_value($search);
      $user = new Recruiter();
      $result = $user->search($search);



      if (!$search) {
        $this->render('home');
      } else {
        if (isset($result)) {
          $this->render('home', ['result' => $result]);
        } else {
          $results =  $user->empty_search();
          $this->render('home', ['error' => $user->output_error(), 'results' => $results]);
        }
      }
    }
  }

  public function saveJob()
  {
    $userid = $this->session->get_session('userid');
    if ($this->session->get_session('loggedin')) {
      !isset($_SESSION['jobs'][$userid]) ? $_SESSION['jobs'][$userid] = [] : $_SESSION['jobs'][$userid];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $save = $_POST['save'];
      $id = $_POST['jobid'];

      $job = new Recruiter();
      $result = $job->get_recruiter_id($id);

      if (isset($save)) {
        if (isset($_SESSION['jobs'][$userid])  && $this->session->get_session('loggedin')) {
          if (!array_key_exists($id, $_SESSION['jobs'][$userid])) {
            $_SESSION['jobs'][$userid][$id] = $result;
          } else {
            $_SESSION['jobs'][$userid][$id];
          }
        } else {
          header('location:/Jobsrchm/app/Login/loginForm');
        }
      }
    }
    $this->render('dashboard');
  }


  public function removeJob()
  {
    $userid = $this->session->get_session('userid');
    $rsave = $_POST['rsave'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['rjobid'];
    }

    if (isset($rsave)) {
      unset($_SESSION['jobs'][$userid][$id]);
    }



    $this->render('dashboard');
  }

  public function locationRequest()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['loc']) {
      $location = $_POST['loc'];
      $users = new Recruiter();


      if (isset($location)) {
        $result = $users->ajax_search($location);
        echo  $result;
      }
    }
  }





  public function viewMore()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $id = $_REQUEST['id'];
    }
    $user = new Recruiter();
    $result = $user->get_recruiter_id($id);

    $this->render('viewmore', ['viewResult' => $result]);
  }


  public function applyJob()
  {

    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //$this->file_handle();
      $data = [
        'firstname' =>  $_REQUEST['firstname'],
        'lastname' =>   $_REQUEST['lastname'],
        'filename' => $_FILES['filename']['name'],
        'submit' => $_REQUEST['submit']
      ];



      $validation = new Validation();
      $user = new User();
      $validation->apply_job_validation($data);

      $this->sanitize_value($data);


      if (!$validation->pass()) {

        $user->apply_job($data['firstname'], $data['lastname'], $data['filename'], $data['submit'], $id);
      }
    }


    $this->render('applyjob', ['apply_validator' => !isset($validation) ? $validator = new Validation() : $validation, 'applyerror' => !isset($user) ? $user = new User() : $user]);
  }
}
