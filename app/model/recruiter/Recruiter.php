<?php

namespace model\recruiter;

class Recruiter
{


  public function search($Search)
  {


    $sql = ("SELECT RecruiterID, JobType, JobDescription, PostDate,DueDate,Location FROM Recruiter WHERE JobType LIKE '%{$Search}%'");

    $query = $this->conn->pdo->prepare($sql);

    $query->execute();

    if ($Search) {


      while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
        $this->srch .= $row['JobType'];
        $this->srch .= $row['JobDescription'];
        $this->srch .= $row['PostDate'];
        $this->srch .= $row['DueDate'];
        $this->srch .= $row['Location'];
        return $this->srch;
      }
    }
    if (!$Search) {
      $this->error[] = "No Result Found";
    } else {

      $this->error[] = "No match Found";
    }
  }

  public function output_error()
  {
    foreach ($this->error as  $value) {
      echo $value;
    }
  }
}
