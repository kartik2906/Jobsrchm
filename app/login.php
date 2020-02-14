<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/custom.css">

  <title>Login</title>
</head>



<body>



  <nav class="navbar navbar-toggleable-md navbar-light " id="mainNav">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand  href=""><img src=" ./svg/logo.svg"> </a> <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto pl-2">
        <li class="nav-item ">
          <a href="index.html">Home</a>
        </li>
        <li class="nav-item ">
          <a href="about.html">About Us </a>
        </li>
        <li class="nav-item ">
          <a href="">Contact Us </a>
        </li>
        <li class="nav-item ">
          <a href="register.html">Register</a>
        </li>
        <li class="nav-item  ">
          <a class="active" href="login.html">Login </a>
        </li>
      </ul>
      </div>
  </nav>


  <?php

  require_once __DIR__ . '/start.php';

  use model\user\User;
  use helper\Validation;

  $validator1 = new Validation();
  $users = new User();

  if (isset($_POST['Login'])) {

    $validator1->add_error_field('username');
    $validator1->add_error_field('password');



    if (!$validator1->pass()) {

      $users->login_user('username', 'password');
    }
  }




  ?>




  <section id="login-heading">
    <div class="cotainer text-center">
      <div class="row">
        <div class="col-md-12">
          <h1>Login</h1>
          <br>
          <hr id="line">
        </div>
      </div>
    </div>
  </section>


  <?php

  $users->output_error(); ?>
  <div class="container" id="login">

    <form method="post" action="">
      <div class="row">
        <div class=" col-md-12 offset-md-12">
          <div class="form-login text-center">
            <?php $validator1->output_error('username'); ?>
            <input type="text" name="username" class="form-control input-sm chat-input" placeholder="Username" />
            </br>
            <?php $validator1->output_error('password'); ?>
            <input type="text" name="password" class="form-control input-sm chat-input" placeholder="Password" />
            </br>
            <div class="wrapper">
              <span class="group-btn">
                <button class="btn btn-lg btn-primary btn-block" name="Login">Login</button>
              </span>

            </div>

          </div>
          <div class="col-md-12 offset-md-12 text-center">
            <h6>dont have an account</h6>
            <a href="#">Register <span class="sr-only">(current)</span></a>
          </div>

        </div>

      </div>
    </form>
  </div>







  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>

</html>