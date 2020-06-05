<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>SB Admin 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="http://localhost/Jobsrchm/app/adminassets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
  <!-- Custom styles for this template-->
  <link href="http://localhost/Jobsrchm/app/adminassets/css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> User Admin <sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Jobs</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Jobs:</h6>
            <a class="collapse-item" href="buttons.html"></a>
            <a class="collapse-item" href="cards.html"></a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />





      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>

              </a>

              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>

                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - save job -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bookmark"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">

                  <?php
                  if (!empty($_SESSION['jobs'][$this->session->get_session('userid')])) {
                    echo  count($_SESSION['jobs'][$this->session->get_session('userid')]);
                  }


                  ?>




                </span>

              </a>

              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Saved jobs
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"></div>
                    <span class="font-weight-bold">
                      <?php
                      if (isset($_SESSION['jobs']) && !empty($_SESSION['jobs'][$this->session->get_session('userid')])) {
                        foreach ($_SESSION['jobs'][$this->session->get_session('userid')] as $key => $value) {
                          foreach ($value as $key => $values) {
                      ?>
                            <div class="small text-gray-500">Jobtype</div>
                            <span class="font-weight-bold"><?php echo $values->jobtype; ?></span>
                      <?php
                          }
                        }
                      }

                      ?>



                    </span>
                  </div>
                </a>

                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php if ($this->session->get_session('loggedin')) { ?>
                    <p id="username" style="color:grey;"> <?php echo  $this->session->get_session('username') ?> </p>
                  <?php
                  }
                  ?>
                </span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60" />
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?php if ($this->session->get_session('loggedin')) { ?>
                    <a class="dropdown-item" href="/Jobsrchm/app/Login/Logout">Logout </a>
                  <?php
                  }
                  ?>
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->
        <?php
        if ($this->session->get_session('loggedin') and $this->session->get_session('roleid') == 1) {
        ?>
          <h1>
            <p class="card-text">Applied jobs :</p>
          </h1>

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
                  <a href="/Jobsrchm/app/Home/viewMore?id=<?php echo $value->recruiterid ?>" class="btn btn-primary">view more</a>
                  <form action="/Jobsrchm/app/Home/saveJob" method="post">
                    <button class="btn" name="save" type="submit"><i class="fas fa-heart" style="color:grey"></i></button>
                    <input type="hidden" name="jobid" value="<?php echo $value->recruiterid  ?>"></input>
                  </form>
                </div>
              </div>
          <?php
            }
          }
          ?>
        <?php
        } else {
        ?>
          <h1>
            <p class="card-text">Jobs you posted :</p>
          </h1>

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
                  <a href="/Jobsrchm/app/Home/viewMore?id=<?php echo $value->recruiterid ?>" class="btn btn-primary">view more</a>
                  <form action="/Jobsrchm/app/Home/saveJob" method="post">
                    <button class="btn" name="save" type="submit"><i class="fas fa-heart" style="color:grey"></i></button>
                    <input type="hidden" name="jobid" value="<?php echo $value->recruiterid  ?>"></input>
                  </form>
                </div>
              </div>
          <?php
            }
          }
          ?>

        <?php
        }
        ?>







        <!-- Bootstrap core JavaScript-->
        <script src="http://localhost/Jobsrchm/app/adminassets/vendor/jquery/jquery.min.js"></script>
        <script src="http://localhost/Jobsrchm/app/adminassets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="http://localhost/Jobsrchm/app/adminassets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="http://localhost/Jobsrchm/app/adminassets/js/sb-admin-2.min.js"></script>
</body>

</html>