<?php

namespace app\model;

// require_once __DIR__ . '/../../start.php';

use app\config\Database;
use app\helper\Session;
use app\helper\Security;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use PDOException;

class User
{


  public $db;
  public $FirstName;
  public $Lastname;
  public $DOB;
  public $userName;
  public $password;
  public $RoleID;
  private $error = array();
  private $success = array();
  public $session;

  public function __construct()
  {
    $this->session = new Session();
    $this->conn = new Database();

    // $this->session->session_init();
  }

  // public function post()
  // {
  // }


  public function reg_user($firstName, $lastName, $email, $userName, $password, $roleId)
  {

    $this->firstName = trim($firstName);
    $this->lastName = trim($lastName);
    $this->$email = trim($email);
    $this->userName = trim($userName);
    $this->$password = trim($password);
    $hash = $this->encrypt($this->password);
    $this->roleId = trim($roleId);
    $security = new Security();
    $token =  $security->emailToken();



    if ($this->check_user_exist($this->userName)) {
      $this->error[] = "username already exist";
    } elseif ($this->check_user_exist($this->userName) < 1) {

      $sql = "INSERT INTO User ( firstname, lastname, email, username, passwords, roleid, token, emailverify ) VALUES ( :firstname, :lastname, :email, :username, :passwords, :roleid, :token, :emailverify )";


      $query =  $this->conn->pdo->prepare($sql);
      $result = $query->execute(array(':firstname' => $this->firstName, ':lastname' => $this->lastName, ':email' => $this->$email, ':username' => $this->userName, ':passwords' => $hash, ':roleid' => $this->roleId, ':token' => $token, ':emailverify' => 0));


      $this->send_email($email, $token, $firstName);

      if ($result) {
        $this->success[] = "registerd sussecfull";
      }
    }
  }

  public function send_email($email, $token, $firstName)
  {

    $mail = new PHPMailer();
    try {
      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = EMAIL;                     // SMTP username
      $mail->Password   = PASSWORD;                               // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 587;

      $mail->setFrom(EMAIL, 'Job search');
      $mail->addAddress($email, $firstName);     // Add a recipient


      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Verify your email';
      $mail->Body    = "Please verify your email by clicking below<br></br>
        <a href='http://localhost/Jobsrchm/app/Register/emailVerified?email=$email&token=$token'> link<a/>";
      $mail->send();
      echo 'Message has been sent';
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }

  public function check_email_token($token, $email)
  {

    $sql = ("SELECT email, firstname, token FROM User WHERE email = :email AND token = :token");
    $sql = $this->conn->pdo->prepare($sql);
    $sql->execute([
      'email' => $email,
      'token' => $token
    ]);
    $result = $sql->fetch(\PDO::FETCH_ASSOC);
    if (!$result) {
      $this->error[] = "something went wrong";
    }
  }

  public function verified($email)
  {
    $num = 1;

    $sql = ("UPDATE User  SET emailverify = :num WHERE email = :email ");
    $sql = $this->conn->pdo->prepare($sql);
    $result = $sql->execute([
      ':email' => $email,
      ':num' => $num
    ]);
    if ($result) {
      return $result;
    }
    return false;
  }



  public function check_user_exist($userName)
  {
    try {
      $userNamecheck = ("SELECT * FROM User  WHERE username = :userName ");
      $userCheck = $this->conn->pdo->prepare($userNamecheck);
      $userCheck->execute([
        'userName' => $userName
      ]);

      return  $userCheck->fetchColumn();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }




  public function login_user($userName, $password)
  {

    $this->userName = trim($userName);
    $this->password = trim($password);

    try {

      $sql = ("SELECT userid, roleid, username, passwords, firstname, lastname FROM User WHERE  username = :username");

      $query = $this->conn->pdo->prepare($sql);
      $query->execute([
        'username' => $this->userName
      ]);

      $result = $query->fetch(\PDO::FETCH_ASSOC);
      //var_dump($result);
      if ($result === false) {
        $this->error[] = "Username or  password do not match";
      } else {
        $passVerify = password_verify($this->password, $result['passwords']);
        if ($passVerify) {
          $this->multiple_user($result);
        }
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }





  public function multiple_user($result)
  {

    if ($result['roleid'] == 1) {


      $this->session->set_session('userid', $result['userid']);
      $this->session->set_session('firstname', $result['firstname']);
      $this->session->set_session('lastname', $result['lastname']);
      $this->session->set_session('username', $result['username']);
      $this->session->set_session('roleid', $result['roleid']);
      $this->session->set_session('loggedin',  true);

      header("location: /Jobsrchm/app/Home/index");
      return  session_regenerate_id(true);
    } elseif ($result['roleid'] == 2) {

      $this->session->set_session('userid', $result['userid']);
      $this->session->set_session('firstname', $result['firstname']);
      $this->session->set_session('lastname', $result['lastname']);
      $this->session->set_session('username', $result['username']);
      $this->session->set_session('roleid', $result['roleid']);
      $this->session->set_session('loggedin',  true);
      header("location: /Jobsrchm/app/Register/registerForm");
      return session_regenerate_id(true);
    } else {
      $this->error[] = "username or password is not valid";
    }
  }

  public function apply_job($firstName, $lastName, $fileName, $submit, $id)
  {
    trim($firstName);
    trim($lastName);
    $fileType = $_FILES['filename']['type'];
    $fileTemp = $_FILES['filename']['tmp_name'];
    $destination = './uploads/' . $fileName;
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    if (empty($fileName)) {
      $this->error[] = "file must be uploaded";
    } elseif (!empty($fileName)) {
      $arr = array('docx', 'pdf');
      if (!in_array($extension, $arr)) {
        $this->error[] = "only docx and pdf extensions allowed";
      }
      if (in_array($extension, $arr)) {

        if (move_uploaded_file($fileTemp, $destination)) {

          if (!$this->session->get_session('loggedin')) {

            $sql = "INSERT INTO Applied_job ( recruiterid, userid, afirstname, alastname, filename ) VALUES (:recruiterid, :userid,:afirstname, :alastname, :filename)";

            $query =  $this->conn->pdo->prepare($sql);
            $result = $query->execute(array(':recruiterid' => $id, ':userid' => NULL, ':afirstname' => $firstName, ':alastname' => $lastName, ':filename' => $fileName));
            if ($result) {
              $this->succes[] = "you applied for job successfully";
            }
          }
          if ($this->session->get_session('loggedin')) {

            $userNamecheck = ("SELECT userid, recruiterid FROM Applied_job  WHERE userid = :userid AND recruiterid = :recruiterid ");
            $userCheck = $this->conn->pdo->prepare($userNamecheck);
            $userCheck->execute([
              'userid' => $this->session->get_session('userid'),
              'recruiterid' => $id

            ]);

            $result =   $userCheck->fetchColumn();
            if ($result > 1) {
              $this->error[] = "you already applied for this Job";
            } elseif ($result < 1) {
              $sql = "INSERT INTO Applied_job ( recruiterid, userid, afirstname, alastname, filename ) VALUES (:recruiterid, :userid,:afirstname, :alastname, :filename)";

              $query =  $this->conn->pdo->prepare($sql);
              $result = $query->execute(array(':recruiterid' => $id, ':userid' => $this->session->get_session('userid'), ':afirstname' => $firstName, ':alastname' => $lastName, ':filename' => $fileName));
              if ($result) {
                $this->succes[] = "you applied for job successfully";
              }
            }
          }
        }
      }
    }
  }

  private function encrypt($pwd)
  {
    return  password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 10]);
  }

  public function output_error()
  {
    //print_r($this->error);
    foreach ($this->error as  $value) {
      echo  '<p class = "alert alert-danger">' . $value . '</p>';
    }
  }
  public function output_success_error()
  {
    //print_r($this->error);
    foreach ($this->success as  $value) {
      echo  '<p class = "alert alert-danger">' . $value . '</p>';
    }
  }
}
