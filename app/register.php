<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link rel="stylesheet" href="http://localhost/Jobsrchm/app/css/custom.css" />
  <title>Document</title>
</head>

<body>



  <nav class="navbar navbar-toggleable-md navbar-light " id="mainNav">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand  href=""><img src=" ./svg/logo.svg"> </a> <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto pl-2">
        <li class="nav-item">
          <a href="/Jobsrchm/app/Home/index">Home </a>
        </li>
        <li class="nav-item ">
          <a href="about.html">About Us </a>
        </li>
        <li class="nav-item  ">
          <a href="">Contact Us</a>
        </li>
        <li class="nav-item  ">
          <a class="active" href="/Jobsrchm/app/Register/registerForm">Register </a>
        </li>
        <li class="nav-item  ">
          <a href="/Jobsrchm/app/Login/loginForm">Login </a>
        </li>
      </ul>
      </div>
  </nav>




  <section id="register-heading">
    <div class="cotainer text-center">
      <div class="row">
        <div class="col-md-12">
          <h1>Register</h1>
          <br>
          <hr id="line">
        </div>
      </div>
    </div>
  </section>



  <div class="container" id="register">
    <form method="post" action="">
      <div class="row">
        <div class=" col-md-8 offset-md-2">
          <div class="form-register text-center">

            <div>

              <?php
              if ($data['error']->output_error()) {
              ?>
                <?php echo $data['error']->output_error(); ?>
              <?php
              }
              ?>
              <?php
              if ($data['validator']->output_error('firstname')) {
              ?>
                <p class='alert alert-danger'>
                  <?php echo $data['validator']->output_error('firstname'); ?>
                </p>
              <?php
              }
              ?>




              <input type=" text" name="firstname" class="form-control input-sm chat-input" placeholder="Username" />
              </br>
              <?php

              echo $data['validator']->output_error('lastname');
              ?>
              <input type="text" name="lastname" class="form-control input-sm chat-input" placeholder="Password" />
              </br>
              <?php

              echo $data['validator']->output_error('email');
              ?>
              <input type="text" name="email" class="form-control input-sm chat-input" placeholder="Email" />
              </br>
              <?php

              echo $data['validator']->output_error('username');
              ?>
              <input type="text" name="username" class="form-control input-sm chat-input" placeholder="username" />
              </br>
              <?php

              echo $data['validator']->output_error('password');
              ?>
              <input type="text" name="password" class="form-control input-sm chat-input" placeholder="password" />
              </br>
              <?php
              echo $data['validator']->output_error('roleid');
              ?>
              <br>
              <span class="label label-default"> keys: User = 1 &nbsp Recruiter = 2 </span>
              <input type="text" name="roleid" class="form-control input-sm chat-input" placeholder="Role: Input 1 or 2" />
              <div class="reg-wrapper">
                <span class="group-btn ">
                  <button class="btn btn-lg btn-primary btn-block" name="Register">Register</button>

                </span>

              </div>
              <input type="hidden" name="token" value="<?php echo $data['tokens']->csrf_token(); ?>" />

            </div>

          </div>

        </div>
    </form>
  </div>
  <section class="info">
    <div class="container text-left">
      <div class="row">
        <div class="col-md-12">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, suscipit, laboriosam. Iure dolor, explicabo officia neque beatae commodi nostrum repellat nihil, minus esse ullam illum perspiciatis quae, sed amet saepe officiis ex quod accusamus aliquid. Reiciendis eligendi, dignissimos nostrum molestias quaerat, deserunt quisquam consequuntur autem maiores animi mollitia quo non.
          </p>
        </div>
      </div>
    </div>
  </section>




  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>

</html>