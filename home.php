
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/custom.css">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="main.js"></script>


  <title>Hello, world!</title>
</head>

<body>



    <nav class="navbar navbar-toggleable-md navbar-light " id="mainNav">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <a class="navbar-brand  href=""><img src="./svg/logo.svg"></a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto pl-2">
          <li class="nav-item ">
            <a class="active"  href="index.html">Home</a>
          </li>
          <li class="nav-item ">
            <a   href="about.html">About Us </a>
          </li>
          <li class="nav-item ">
            <a  href="">Contact Us </a>
          </li>
          <li class="nav-item ">
            <a  href="register.php">Register</a>
          </li>
          <li class="nav-item">
            <a id="border"  href="login.html">Login </a>
          </li>
        </ul>
      </div>
    </nav>

<header class="masthead text-center">
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
                <form action = "" method="get">
                <div class="container" id="search-bar">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="input-group">
                        <input type="text" class="form-control" name = "Search" placeholder="Search for...">
                      </div>
                      <div class="srch-btn">
                        <button type="submit" name = "submit"  class="btn btn-primary">
                          SEARCH
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
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

include('user.php');
$users = new User();


  

if(isset($_GET['Search'])){
  echo $users->search($_GET['Search']);





  $users->output_error();



?>
<?php
}else{
  
?>


<section id="area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center" id="area-heading">
        <h1>Lorem ipsum dolor sit.</h1>
      </div>
    </div>
    <div class="row" id="inside-area"  >
      <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12  " id="col">
        <div class="img">
            <img src="./monitor.png">
        </div>
          <div class="text">
            <a href="#">Technology</a>
          </div>
      </div>
      <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12 " id="col">
        <div class="img">
            <img src="./hand-shake.png">
        </div>
          <div class="text">
            <a href="#">Business</a>
          </div>
      </div>
      <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12" id="col">
          <div class="img">
              <img src="./purchase.png">
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
            <img src="./JobSearch.png">
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
    <div class="row" >
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12"  >
        <img src="./citywide.png">
      </div>
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12" >
        <img src="./capita.png">
      </div>
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12" >
        <img src="./oracle.png">
      </div>
      <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12" >
        <img src="./google.png">
      </div>
    </div>
  </div>
</section>


<section class="post-job text-center ">
  <div class="container">
    <div class="row" >
      <div class="col-md-12">
        <h1>Recruiter</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 ">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae tenetur provident ab aliquam vitae qui.</p>
      </div>
      <div class="col-lg-6">
        <img src="./recruit.png">
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
          <a class="navbar-brand  href=""><img src="./svg/logo.svg"></a>
        </div>
        <div class="col-sm-4 " id="foot-links">
          <a   href="#">About Us <span class="sr-only">(current)</span></a>
          <a   href="#">Contact Us <span class="sr-only">(current)</span></a>
        </div>
      </div>
    </div>
  </section>
</footer>










<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


</body>

</html>
