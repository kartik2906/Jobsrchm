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
            // $api_search = !isset($_REQUEST['api_search']) ? $_REQUEST['api_search'] = '' : $_REQUEST['search'];
            $search =  $this->sanitize_single_value($search);
            $user = new Recruiter();
            $result = $user->search($search);
        }
        if (!$search) {
            $this->render('home');
        }
        if ($search && isset($result)) {
            $apiResult = $this->fetchReedApi();
            $this->render('home', ['result' => $result, 'apiResult' => $apiResult]);
        } else {
            $results =  $user->emptySearch();
            $this->render('home', ['error' => $user->output_error(), 'results' => $results]);
        }
    }

    private function fetchReedApi()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $apiseaech = !isset($_REQUEST['search']) ?   $_REQUEST['search'] = '' : $_REQUEST['search'];
            $username = APIKEY;
            $password = APIPASSWORD;
            $token = base64_encode("$username:$password");
            if (isset($apiseaech)) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.reed.co.uk/api/1.0/search?keywords=" . $apiseaech,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
          // CURLOPT_USERPWD => $username . ":" . $password,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Basic $token",
            "Content-Type: application/json",
            "cache-control: no-cache"
          ),
        ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    return json_decode($response);
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
            $result = $job->getRecruiterId($id);
        }
        if (isset($save) && isset($_SESSION['jobs'][$userid])  && $this->session->get_session('loggedin') && !array_key_exists($id, $_SESSION['jobs'][$userid])) {
            $_SESSION['jobs'][$userid][$id] = $result;
        } else {
            // $_SESSION['jobs'][$userid][$id];
            header('location:/app/public/Login/loginForm');
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
                $result = $users->ajaxSearch($location);
                echo  $result;
            }
        }
    }

    public function viewMore($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_REQUEST['id'];
        }
        $user = new Recruiter();
        $result = $user->getRecruiterId($id);

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
                // $user->applyJob($data['firstname'], $data['lastname'], $data['filename'], $data['submit'], $id);

                $user->applyJob($data, $id);
            }
        }


        $this->render('applyjob', ['apply_validator' => !isset($validation) ? $validator = new Validation() : $validation, 'applyerror' => !isset($user) ? $user = new User() : $user]);
    }
}
