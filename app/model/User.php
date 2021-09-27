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
    public $conn;
    public $firstName;
    public $lastName;
    public $email;
    public $userName;
    public $password;
    public $roleId;
    public $emailVerify;
    private $error = array();
    private $success = array();
    public $session;

    public function __construct()
    {
        $this->conn = new Database();
        $this->conn->connect();
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of DOB
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmailVerify($verifyNo = 0)
    {
        $this->emailVerify = $verifyNo;
    }

    public function getEmailVerify()
    {
        return $this->emailVerify;
    }
    /**
     * Set the value of DOB
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->encrypt($this->password);
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of RoleID
     */
    public function getRoleID()
    {
        return $this->roleId;
    }

    /**
     * Set the value of RoleID
     *
     * @return  self
     */
    public function setRoleID($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }
    /**
         * Get the value of fileName
         */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @return  self
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getEmailToken()
    {
        $security = new Security();
        $token =  $security->emailToken();
        return $token;
    }


    /**
     *  register user query
     * @param data name are passed are to this function
     */
    public function regUser($data)
    {
        $this->setFirstName(trim($data['firstname']));
        $this->setLastName(trim($data['lastname']));
        $this->setEmail(trim($data['email']));
        $this->setUserName(trim($data['username']));
        $this->setPassword(trim($data['password']));
        $this->setRoleID(trim($data['roleid']));
        $this->setEmailVerify();
        
        if ($this->checkUserExist($this->getUserName())) {
            $this->error[] = "username already exist";
        }
        if (!$this->checkUserExist($this->getUserName()) && $this->checkUserExist($this->getUserName()) < 1) {
            $this->queryInsertUser();
        }
    }


    public function queryInsertUser()
    {
        $sql  = "INSERT INTO User ( firstname, lastname, email, username, passwords, roleid, token, emailverify ) VALUES ( :firstname, :lastname, :email, :username, :passwords, :roleid, :token, :emailverify )";

        $query =  $this->conn->pdo->prepare($sql);

        $result = $query->execute(array(':firstname' => $this->getFirstName(), ':lastname' => $this->getLastName(), ':email' => $this->getEmail(), ':username' => $this->getUserName(), ':passwords' => $this->getPassword(), ':roleid' => $this->getRoleID(), ':token' => $this->getEmailToken(), ':emailverify' => $this->getEmailVerify()));

        // send email
        $this->sendEmail($this->getEmail(), $this->getEmailToken(), $this->getFirstName());

           
        if ($result) {
            $this->success[] = "registerd sussecfull";
            return true;
        }
    }

    /**
     * Send email function
     */
    public function sendEmail($email, $token, $firstName)
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
        <a href='http://localhost/app/public/Register/emailVerified?email=$email&token=$token'> link<a/>";
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    /**
     * Checks email and token from database
     */
    public function checkTokenEmail($token, $email)
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
    /**
     * if users email and token is verified, update the emailverify status
     */
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

    

    public function checkUserExist($userName)
    {
        try {
            $userCheck = $this->conn->pdo->prepare("SELECT * FROM User  WHERE username = :userName");

            $userCheck->execute(array(':userName' => $userName ));
            // $userCheck->bindParam(':userName', $userName);
            $result = $userCheck->fetchColumn();
            if ($result) {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    /**
     * Login user functionality
     */
    public function loginUser($userName, $password)
    {
        $this->setUserName(trim($userName));
        $this->setPassword(trim($password));

        try {
            $sql = ("SELECT userid, roleid, username, passwords,emailverify, firstname, lastname FROM User WHERE  username = :username");

            $query = $this->conn->pdo->prepare($sql);
            $query->execute([
        ':username' => $this->getUserName(),
      ]);

            $result = $query->fetch(\PDO::FETCH_ASSOC);
            //var_dump($result);
            if ($result === false) {
                $this->error[] = "Username or  password do not match";
            } else {
                $passVerify = password_verify($this->password, $result['passwords']);
                if ($passVerify) {
                    $this->checkUserRole($result);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function setSession($result)
    {
        $this->session = new Session();
        $this->session->setSession('userid', $result['userid']);
        $this->session->setSession('firstname', $result['firstname']);
        $this->session->setSession('lastname', $result['lastname']);
        $this->session->setSession('username', $result['username']);
        $this->session->setSession('roleid', $result['roleid']);
        $this->session->setSession('loggedin', true);
    }

    /**
     * Multiple User function
     */
    public function checkUserRole($result)
    {
        if ($result['roleid'] == 1) {
            $this->setSession($result);
            header("location: /app/public/Home/index");
            return  session_regenerate_id(true);
        } elseif ($result['roleid'] == 2  && $result['emailverify'] == 1) {
            $this->setSession($result);
            header("location: /app/public/Register/registerForm");
            return session_regenerate_id(true);
        } else {
            $this->error[] = "username or password is not valid or verify your email";
        }
    }

    /**
     * Apply job functionality
     * User can send CV with the type of docx or pdf
     * Only if user user logged will set the foriegn id to the logged in id else will set it 0
     */
    public function applyJob($data, $id)
    {
        $this->session = new Session();
        $this->setFirstName($data['firstname']);
        $this->setLastName($data['lastname']);
        $this->setFileName($data['filename']);
        $fileType = $_FILES['filename']['type'];
        $fileTemp = $_FILES['filename']['tmp_name'];
        $destination = '../uploads/' .$this->getFileName();
        $extension = pathinfo($this->getFileName(), PATHINFO_EXTENSION);
        $arr = array('docx', 'pdf');
        if (empty($this->getFileName())) {
            $this->error[] = "file must be uploaded";
        }

        if (!empty($this->getFileName()) && !in_array($extension, $arr)) {
            $this->error[] = "only docx and pdf extensions allowed";
        }

        if (in_array($extension, $arr) && move_uploaded_file($fileTemp, $destination)) {
            $this->notLoggedInUserApplyQuery($id);
            $this->checkUserIfAlreadyApplied($id);
        }
    }

    public function checkUserIfAlreadyApplied($id)
    {
        $this->session = new Session();
        if ($this->session->getSession('loggedin')) {
            $userNamecheck = ("SELECT userid, recruiterid FROM Applied_job  WHERE userid = :userid AND recruiterid = :recruiterid ");
            $userCheck = $this->conn->pdo->prepare($userNamecheck);
            $userCheck->execute([
            'userid' => $this->session->getSession('userid'),
            'recruiterid' => $id]);

            $result =   $userCheck->fetchColumn();

            $this->applyJobApplication($result, $id);
        }
    }

    public function applyJobApplication($result, $id)
    {
        if ($result > 1) {
            $this->error[] = "you already applied for this Job";
        } elseif ($result < 1) {
            $sql = "INSERT INTO Applied_job ( recruiterid, userid, afirstname, alastname, filename ) VALUES (:recruiterid, :userid,:afirstname, :alastname, :filename)";

            $query =  $this->conn->pdo->prepare($sql);
            $result = $query->execute(array(':recruiterid' => $id, ':userid' => $this->session->getSession('userid'), ':afirstname' => $this->getFirstName(), ':alastname' => $this->getLastName(), ':filename' => $this->getFileName()));
            if ($result) {
                $this->succes[] = "you applied for job successfully";
            }
        }
    }
    public function notLoggedInUserApplyQuery($id)
    {
        $this->session = new Session();
        if (!$this->session->getSession('loggedin')) {
            $sql = "INSERT INTO Applied_job ( recruiterid, userid, afirstname, alastname, filename ) VALUES (:recruiterid, :userid,:afirstname, :alastname, :filename)";

            $query =  $this->conn->pdo->prepare($sql);
            $result = $query->execute(array(':recruiterid' => $id, ':userid' => null, ':afirstname' => $this->getFirstName(), ':alastname' => $this->getLastName(), ':filename' => $this->getFileName()));
            if ($result) {
                $this->succes[] = "you applied for job successfully";
            }
        }
    }



    /**
     * encrypt password functionality
     */
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
