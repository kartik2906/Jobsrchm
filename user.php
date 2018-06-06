    <?php
    	
      include('db_connection.php');
      session_start();

    	class User{

            private $error = array();
            private $conn;
            private $srch;

            public function  __construct(){
               $this->conn = new Database;
            }

            //same username  cannoot be inserted in a database 
        public function check_user_exist ($uname){
            
             try{
                 $usernamecheck = ("SELECT * FROM User  WHERE userName = '$uname' ");
                 $userchck = $this->conn->pdo->prepare( $usernamecheck );
                 $userchck -> execute([
                    'userName' => $uname,
                 ]);
                    
                 return  $userchck->fetchColumn() > 0;

             }
              catch(PDOExeception $e)
                {
                    echo $e->getMessage();
                 }
           
                

        }

        public function search ($Search){

            
            $sql = ("SELECT RecruiterID, JobType, JobDescription, PostDate,DueDate,Location FROM Recruiter WHERE JobType LIKE '%{$Search}%'");

                    $query = $this->conn->pdo->prepare($sql);

                    $query->execute();

                    if ($Search) {


                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                           $this->srch .= $row ['JobType'];
                           $this->srch .= $row ['JobDescription'];
                           $this->srch .= $row ['PostDate'];
                           $this->srch .= $row ['DueDate'];
                           $this->srch .= $row ['Location'];
                            return $this->srch;
        
                            }
                    }
                    if (!$Search) {
                        $this->error[] = "No Result Found";

                    } else{
                       
                        $this->error[] = "No match Found";
                    }
                  
           
            }





        public function login_user($username, $password){
            

            $user = ($_POST[$username]);
            $pass = ($_POST[$password]);

            try{

                $sql = ("SELECT UserID, RoleID FROM User WHERE  userName = '$user' AND password = '$pass' ");
            
                $query = $this->conn->pdo->prepare($sql);
                 $query -> execute([
                     'userName' => $username,
                     'password' => $password,
    
                     ]);
                     
                $result = $query-> fetch(PDO::FETCH_ASSOC);
                
                 $this->multiple_user($result);

            }
            catch(PDOExeception $e)
            {
                echo $e->getMessage();
             }

            
          
        } 





        public function multiple_user($result){
            
            if($result['RoleID'] == 1) {
                $_SESSION['userName'];
                //$_SESSION['UserID'] = $result['UserID'];
                //$_SESSION['JobID'] = $result['JobID'];
                header("location: user.php");
                
               
            }elseif ($result['RoleID'] == 2) {
                $_SESSION['userName'];
                //$_SESSION['UserID'] = $result['UserID'];
                //$_SESSION['JobID'] = $result['JobID'];
                header("location: recruiter.php");
                
            
            }else{
                $this->error[] = "username or password is not valid";
            }

        }





            //register user 
            public function reg_user($firstname, $lastname, $dob, $username, $password, $roleid){

                
                $fname = trim($_POST[$firstname]);
                $lname = trim($_POST[$lastname]);
                $dfbirth = trim($_POST[$dob]);
                $uname = trim($_POST[$username]);
                $pwd = trim($_POST[$password]);
                $hash = $this->encrypt($pwd);
                $rid = trim($_POST[$roleid]);

               

                if ($this->check_user_exist($uname)) {
                     $this->error[$uname] = "username already exist";
                } elseif ($this->check_user_exist($uname)< 1) {
                
                    $sql = "INSERT INTO User ( FirstName, LastName, DOB, userName, password, RoleID ) VALUES ( :FirstName, :LastName, :DOB, :userName, :password, :RoleID )";

                    $query =  $this->conn->pdo->prepare( $sql );
                    $query = $query->execute( array( ':FirstName'=>$fname, ':LastName'=>$lname, ':DOB'=>$dfbirth, ':userName'=>$uname, ':password'=>$hash, ':RoleID'=>$rid ) );

                   $this->error[] = "registerd sussecful";

                }
    	}



        public function output_error(){
                foreach ($this->error as  $value) {
               echo $value;
            }
            
    }


        private function encrypt($pwd){
           return  password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 10]);
        }
        

        

       
        
    }


      ?>