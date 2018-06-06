  <?php 
include('validation.php');
include('user.php');
$validator = new Validation();

  if (isset($_POST['Register'])) {

        
        $validator->add_field('firstname');
        $validator->add_rule_to_field('firstname', array('empty'));

        $validator->add_field('lastname');
        $validator->add_rule_to_field('lastname', array('empty'));

        $validator->add_field('dob');
        $validator->add_rule_to_field('dob', array('empty'));

        $validator->add_field('username');
        $validator->add_rule_to_field('username', array('empty'));

        $validator->add_field('password');
        $validator->add_rule_to_field('password', array('empty'));

        $validator->add_field('roleid');
        $validator->add_rule_to_field('roleid', array('empty'));

        
       
       if (!$validator->passed()){
        $users = new User();
         $users->reg_user('firstname', 'lastname','dob','username','password','roleid');
       }

       

  }



   ?>