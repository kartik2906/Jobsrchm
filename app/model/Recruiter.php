<?php

namespace app\model;



// require_once __DIR__ . '/../../start.php';

use app\config\Database;
use PDOException;

class Recruiter
{

  public $error = array();


  public function __construct()
  {
    $this->conn = new Database();
  }



  public function search($Search)
  {


    $sql = ("SELECT recruiterid, jobtype, jobdescription, postdate,duedate,location FROM Recruiter WHERE jobtype LIKE '%{$Search}%'");

    $query = $this->conn->pdo->prepare($sql);

    $query->execute();

    if ($Search) {


      while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
        $result[] = $row;
      }
    }
    if (isset($result)) {
      return $result;
    } else {
      $this->error['rerror'] = "No Match Found";
    }




    // if (!$Search) {
    //   $this->error[] = "No Result Found";
    // } else {

    //   $this->error[] = "No match Found";
    // }
  }
  public function ajax_search($location)
  {
    $sql = ("SELECT recruiterid,location,jobtype, jobdescription, postdate,duedate FROM Recruiter WHERE location LIKE '%{$location}%'");

    $query = $this->conn->pdo->prepare($sql);

    $query->execute();

    if ($location) {

      $result = array();
      while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
        $result[] = array(
          'location' => $row['location'],
          'jobtype' => $row['jobtype'],
          'jobdescription' => $row['jobdescription'],
          'recruiterid' => $row['recruiterid'],
        );
      }
      return  json_encode($result);
    }
    //if (isset($result)) {

    // }
  }

  public function empty_search()
  {
    $sql = ("SELECT * From Recruiter");
    $query = $this->conn->pdo->prepare($sql);

    $query->execute();
    while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
      $result[] = $row;
    }
    if (isset($result)) {
      return $result;
    }
  }

  public function get_recruiter_id($id)
  {

    $sql = ("SELECT recruiterid, jobtype, jobdescription, postdate,duedate,location FROM Recruiter WHERE recruiterid = :id ");
    $query = $this->conn->pdo->prepare($sql);
    $query->execute([
      'id' => $id
    ]);
    while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
      $result[] = $row;
    }
    if (isset($result)) {
      return $result;
    }
  }


  public function output_error()
  {
    foreach ($this->error as $key =>  $value) {
      return $value;
    }
  }
}
