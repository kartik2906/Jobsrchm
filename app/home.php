<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link rel="stylesheet" href="../../public/css/custom.css">
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="../../main.js"></script>






  <title>Job Search!</title>
</head>

<body>



  <nav class="navbar navbar-toggleable-md navbar-light " id="mainNav">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand  href=""><img src=" http://localhost/Jobsrchm/app/svg/logo.svg"> </a> <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto pl-2">
        <li class="nav-item ">
          <a class="active" href="/app/public/Home/index">Home</a>
        </li>
        <li class="nav-item ">
          <a href="about.html">About Us </a>
        </li>
        <li class="nav-item ">
          <a href="">Contact Us </a>
        </li>
        <li class="nav-item ">
          <?php if (!$this->session->getSession('loggedin')) { ?>
            <a href="/app/public/Register/registerForm">Register</a>
          <?php
          }
          ?>

        </li>
        <li class="nav-item">
          <?php if (!$this->session->getSession('loggedin')) { ?>
            <a id="border" href="/app/public/Login/loginForm">Login </a>
          <?php
          }
          ?>

        </li>
        <?php if ($this->session->getSession('loggedin')) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php if ($this->session->getSession('loggedin')) { ?>
                <p id="username" style="color:white;"> <?php echo  $this->session->getSession('username') ?> </p>
              <?php
              }
              ?>
            </a>
            <div class="dropdown-menu drop" id="drop">
              <?php if ($this->session->getSession('loggedin')) { ?>
                <a class="dropdown-item" href="/app/public/Dashboard/userDashboard">Dashboard </a>
              <?php
              }
              ?>
              <?php if ($this->session->getSession('loggedin')) { ?>
                <a class="dropdown-item" href="/app/public/Login/Logout">Logout </a>
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

  <header class=" masthead text-center">
    <div id="showcase">
      <div id="layer">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <p>
                Lorem ipsum dolor sit amet.
              </p>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-12 ">
                <div id="srch-layer">
                  <form action="" method="get">
                    <div class="container" id="search-bar">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search for...">
                          </div>
                          <div class="srch-btn">
                            <button class="btn btn-lg btn-primary btn-block">SEARCH</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <form action="" method="post">
                    <select name="location" id="location">
                      <option selected disabled> Location </option>
                      <option value="London">London</option>
                      <option value="Mancheter">Manchester</option>
                    </select>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <i class="down"></i>
        </div>
      </div>
    </div>


  </header>



  <?php


  if (isset($data['result'])) {
      foreach ($data['result'] as $key => $value) {
          ?>


      <div class="card" id="result">
        <div class="card-header">
          <?php echo $value->jobtype; ?>

        </div>
        <div class="card-body">
          <h5 class="card-title"></h5>
          <p class="card-text"><?php echo $value->jobdescription; ?></p>
          <p class="card-text"> <?php echo $value->location; ?></p>
          <a href="/app/public/Home/viewMore?id=<?php echo $value->recruiterid ?>" class="btn btn-primary">view more</a>

          <?php
          $userid = $this->session->getSession('userid');
          !isset($_SESSION['jobs'][$userid]) ? $_SESSION['jobs'][$userid] = [] : $_SESSION['jobs'][$userid];
          if (!array_key_exists($value->recruiterid, $_SESSION['jobs'][$this->session->getSession('userid')])) {
              ?>
            <form action="/app/public/Home/saveJob" method="post" id="saveform">
              <button class="btn" id="savebtn" name="save" type="submit" href=""><i style="color:lightgrey" class="far fa-heart" ></i></button>
              <input type="hidden" name="jobid" value="<?php echo $value->recruiterid  ?>"></input>
            </form>
          <?php
          } else {
              ?>

            <form action="/app/public/Home/removeJob" method="post" id="saveform">
              <button class="btn" id="savebtn" name="rsave" type="submit"><i class="fas fa-heart" style="color:black"></i></button>
              <input type="hidden" name="rjobid" value="<?php echo $value->recruiterid  ?>"></input>
            </form>
          <?php
          } ?>
        </div>
      </div>
      <?php
      }
      if (isset($data['apiResult']->results)) {
          foreach ($data['apiResult']->results as $result) {
              ?>
        <div class="card">
          <div class=" card-header">
            <?php echo $result->jobTitle; ?>

          </div>
          <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text"><?php echo $result->jobDescription; ?></p>
            <p class="card-text"> <?php echo $result->locationName; ?></p>
            <a href="<?php echo $result->jobUrl ?>" class="btn 
          btn-primary">view more</a>
          </div>
        </div>

    <?php
          }
      } ?>

    <?php
  } elseif (isset($data['results'])) {
      if (isset($data['error'])) {
          echo $data['error'];
          echo "</p>Please try following result: </p>";
      }
      foreach ($data['results'] as $key => $values) {
          ?>
      <div class="card">
        <div class=" card-header">
          <?php echo $values->jobtype; ?>

        </div>
        <div class="card-body">
          <h5 class="card-title"></h5>
          <p class="card-text"><?php echo $values->jobdescription; ?></p>
          <p class="card-text"> <?php echo $values->location; ?></p>
          <a href="/app/public/Home/viewMore?id=<?php echo $values->recruiterid ?>" class="btn 
          btn-primary">view more</a>
        </div>
      </div>
    <?php
      } ?>



  <?php
  } else {
      ?>


    <section id="area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center" id="area-heading">
            <h1>Lorem ipsum dolor sit.</h1>
          </div>
        </div>
        <div class="row" id="inside-area">
          <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12  " id="col">
            <div class="img">
              <img src="../../public/images/monitor.png">
            </div>
            <div class="text">
              <a href="#">Technology</a>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12 " id="col">
            <div class="img">
              <img src="../../public/images/hand-shake.png">
            </div>
            <div class="text">
              <a href="#">Business</a>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12" id="col">
            <div class="img">
              <img src="../../public/images/purchase.png">
            </div>
            <div class="text">
              <a href="#">Retail</a>
            </div>
          </div>
        </div>
      </div>
    </section>



    <section id="company-jobs">
      <div id="comp-layer">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="job-img">
                <img src="../../public/images/JobSearch.png">
              </div>
              <p class="">Look for </p>
              <div class="comp-btn">
                <button type="button" class="btn btn-primary">
                  <a href="#">Company Jobs</a>
                </button>
              </div>
              <div class="col-lg-6 offset-lg-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing consectetur adipisicing.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section id="comp-brand" class="text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
            <img src="../../public/images/citywide.png">
          </div>
          <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
            <img src="../../public/images/capita.png">
          </div>
          <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
            <img src="../../public/images/oracle.png">
          </div>
          <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
            <img src="../../public/images/google.png">
          </div>
        </div>
      </div>
    </section>


    <section class="post-job text-center ">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>Recruiter</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 ">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae tenetur provident ab aliquam vitae qui.</p>
          </div>
          <div class="col-lg-6">
            <img src="../../public/images/recruit.png">
          </div>
        </div>
      </div>
    </section>


  <?php
  }

  ?>


  <footer class="text-center">
    <section id="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-4 copyright">
            © 2016 Copyright: <a href="https://www.MDBootstrap.com"> MDBootstrap.com </a>
          </div>
          <div class="col-sm-4 ">
            <a class="navbar-brand  href=""><img src=" http://localhost/Jobsrchm/app/svg/logo.svg"> </a> </div> <div class="col-sm-4 " id="foot-links">
              <a href="#">About Us <span class="sr-only">(current)</span></a>
              <a href="#">Contact Us <span class="sr-only">(current)</span></a>
          </div>
        </div>
      </div>
    </section>
  </footer>







  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>



</body>

</html>