<?php

namespace app\model;

use app\config\Database;
use app\helper\Session;
use PDOException;

class Dashboard
{

  public $error = array();


  public function __construct()
  {
    $this->conn = new Database();
    $this->session = new Session();
  }

  public function applied_job_user()
  {
    $sql = "SELECT Applied_job.userid, firstname, lastname, Applied_job.recruiterid, filename, jobtype,jobdescription,location  from ((User 
    INNER JOIN Applied_job ON User.userid = Applied_job.userid)
    INNER JOIN Recruiter ON Recruiter.recruiterid = Applied_job.recruiterid) WHERE Applied_job.userid = " . $this->session->get_session('userid');

    $query = $this->conn->pdo->prepare($sql);

    $query->execute();

    if ($query) {

      while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
        $result[] = $row;
      }
      if (isset($result)) {
        return  $result;
      }
    }
  }
}
