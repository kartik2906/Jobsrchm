<?php

namespace app\model;

use app\config\Database;
use PDOException;

class Recruiter
{
    public $error = array();

    public $jobType;
    public $jobDescription;
    public $postDate;
    public $dueDate;
    public $location;


    public function __construct()
    {
        $this->conn = new Database();
        $this->conn->connect();
    }

    /**
     * Get the value of jobType
     */
    public function getJobType()
    {
        return $this->jobType;
    }

    /**
     * Set the value of jobType
     *
     * @return  self
     */
    public function setJobType($jobType)
    {
        $this->jobType = $jobType;

        return $this;
    }

    /**
     * Get the value of jobDescription
     */
    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    /**
     * Set the value of jobDescription
     *
     * @return  self
     */
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;

        return $this;
    }

    /**
     * Get the value of postDate
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Set the value of postDate
     *
     * @return  self
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get the value of dueDate
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set the value of dueDate
     *
     * @return  self
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get the value of location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }


    


    /**
     * Seach job functionality
     */

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
    }
    /**
     *
     */
    public function ajaxSearch($location)
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

    public function emptySearch()
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

    public function getRecruiterId($id)
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
