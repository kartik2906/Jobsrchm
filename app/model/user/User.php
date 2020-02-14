<?php

namespace model\user;

session_start();

require_once __DIR__ . '/../../start.php';

use config\Database;

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

  public function __construct()
  {
    $this->conn = new Database();
  }


  public function reg_user($firstName, $lastName, $dob, $userName, $password, $roleId)
  {


    $this->firstName = trim($_POST[$firstName]);
    $this->lastName = trim($_POST[$lastName]);
    $this->$dob = trim($_POST[$dob]);
    $this->userName = trim($_POST[$userName]);
    $this->$password = trim($_POST[$password]);
    $hash = $this->encrypt($this->password);
    $this->roleId = trim($_POST[$roleId]);



    if ($this->check_user_exist($this->userName)) {
      $this->error[$this->userName] = "username already exist";
    } elseif ($this->check_user_exist($this->userName) < 1) {

      $sql = "INSERT INTO User ( firstname, lastname, dob, username, password, roleid ) VALUES ( :firstname, :lastname, :dob, :username, :password, :roleid )";

      $query =  $this->conn->pdo->prepare($sql);
      $query = $query->execute(array(':firstname' => $this->firstName, ':lastname' => $this->lastName, ':dob' => $this->$dob, ':username' => $this->userName, ':password' => $hash, ':roleid' => $this->roleId));

      $this->error[] = "registerd sussecful";
    }
  }


  public function check_user_exist($userName)
  {

    try {
      $userNamecheck = ("SELECT * FROM User  WHERE username = '$userName' ");
      $userCheck = $this->conn->pdo->prepare($userNamecheck);
      $userCheck->execute([
        'userName' => $this->userName,
      ]);

      return  $userCheck->fetchColumn() > 0;
    } catch (PDOExeception $e) {
      echo $e->getMessage();
    }
  }




  public function login_user($userName, $password)
  {


    $this->userName = ($_POST[$userName]);
    $this->password = ($_POST[$password]);

    try {

      $sql = ("SELECT UserID, RoleID FROM User WHERE  username = '$userName' AND password = '$password' ");

      $query = $this->conn->pdo->prepare($sql);
      $query->execute([
        'userName' => $this->userName,
        'password' => $this->password,

      ]);

      $result = $query->fetch(\PDO::FETCH_ASSOC);

      $this->multiple_user($result);
    } catch (PDOExeception $e) {
      echo $e->getMessage();
    }
  }





  public function multiple_user($result)
  {

    if ($result['roleid'] == 1) {
      $_SESSION['username'];
      //$_SESSION['UserID'] = $result['UserID'];
      //$_SESSION['JobID'] = $result['JobID'];
      header("location: user.php");
    } elseif ($result['roleid'] == 2) {
      $_SESSION['username'];
      //$_SESSION['UserID'] = $result['UserID'];
      //$_SESSION['JobID'] = $result['JobID'];
      header("location: recruiter.php");
    } else {
      $this->error[] = "username or password is not valid";
    }
  }

  private function encrypt($pwd)
  {
    return  password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 10]);
  }

  public function output_error()
  {
    foreach ($this->error as  $value) {
      echo $value;
    }
  }
}
