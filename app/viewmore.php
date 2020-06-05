<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link rel="stylesheet" href="http://localhost/Jobsrchm/app/css/custom.css">
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="http://localhost/Jobsrchm/app/main.js"></script>

  <script src="main.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <nav class="navbar navbar-toggleable-md navbar-light " id="mainNav">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand  href=""><img src=" ./svg/logo.svg"> </a> <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto pl-2">
        <li class="nav-item ">
          <a class="active" href="/Jobsrchm/app/Home/index">Home</a>
        </li>
        <li class="nav-item ">
          <a href="about.html">About Us </a>
        </li>
        <li class="nav-item ">
          <a href="">Contact Us </a>
        </li>
        <li class="nav-item ">
          <?php if (!$this->session->get_session('loggedin')) { ?>
            <a href="/Jobsrchm/app/Register/registerForm">Register</a>
          <?php
          }
          ?>
        </li>
        <li class="nav-item">
          <?php if (!$this->session->get_session('loggedin')) { ?>
            <a id="border" href="/Jobsrchm/app/Login/loginForm">Login </a>
          <?php
          }
          ?>
        </li>
        <?php if ($this->session->get_session('loggedin')) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php if ($this->session->get_session('loggedin')) { ?>
                <p id="username" style="color:white;"> <?php echo  $this->session->get_session('username') ?> </p>
              <?php
              }
              ?>
            </a>
            <div class="dropdown-menu drop" id="drop">
              <?php if ($this->session->get_session('loggedin')) { ?>
                <a class="dropdown-item" href="/Jobsrchm/app/Login/Logout">Logout </a>
              <?php
              }
              ?>
            </div>
          </li>
        <?php
        }
        ?>
      </ul>
      </div>
  </nav>


  <?php

  if (isset($data['viewResult'])) {
    foreach ($data['viewResult'] as $key => $value) {
  ?>
      <div class="card " style="width:50%; height:75%; margin-left:25%;">
        <div class="card-header text-center">
          <b> <em><span> Job: <span></em></b>
          <h2> <?php echo $value->jobtype; ?> </h2>

        </div>
        <div>
          <h5 class=" card-title">
          </h5>
          <b><em> <span> Job Description: <span></em></b>
          <p class="card-text"><?php echo $value->jobdescription; ?></p>
          <b><em><span> Location: <span></em></b>
          <p class="card-text"> <?php echo $value->location; ?></p>
        </div>
        <div class="text-center">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            <a href="/Jobsrchm/app/Home/applyJob?id=<?php echo $value->recruiterid ?>" class="btn btn-primary">apply</a>
          </button>
        </div>
      </div>

  <?php
    }
  }
  ?>






  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>

</html>