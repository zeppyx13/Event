<?php
require '../config/php/backend.php';
if (isset($_POST['regis'])) {
  if (regis($_POST) > 0) {
    echo "<script>
    alert('berhasil')
    document.location.href='../../';
    </script>
    ";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../img/apple-icon.png">
  <link rel="icon" type="image/png" href="../img/favicon.png">
  <title>
    JB Pay || Sing UP
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../css/nucleo-icons.css" rel="stylesheet" />
  <link href="../css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../img/illustrations/illustration-signup.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-6 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign Up</h4>
                  <p class="mb-0">Enter your email and password to register</p>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="">
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Nama</label>
                      <input required autocomplete="off" name="nama" type="text" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Username</label>
                      <input required autocomplete="off" name="username" type="text" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Email</label>
                      <input required autocomplete="off" name="email" type="email" class="form-control">
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-5 col-12">
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Password</label>
                          <input id="pw" required autocomplete="off" name="pw" type="password" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-5 col-sm-6 col-10">
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Re-enter PW</label>
                          <input id="pw2" required autocomplete="off" name="pw2" type="password" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-1 col-1">
                        <i class="ms-2 mt-2 material-icons opacity-10" id="iconpw">visibility</i>
                      </div>
                    </div>
                    <div class="text-center">
                      <button name="regis" type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign Up</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="../../" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="../js/core/popper.min.js"></script>
  <script src="../js/core/bootstrap.min.js"></script>
  <script src="../js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    let iconpw = document.getElementById("iconpw");
    let pw = document.getElementById("pw");
    let pw2 = document.getElementById("pw2");
    iconpw.onclick = function() {
      if (pw.type == "password") {
        pw.type = "text";
        pw2.type = "text";
        iconpw.innerHTML = "visibility_off"
      } else {
        pw.type = "password"
        pw2.type = "password"
        iconpw.innerHTML = "visibility"
      }
    }
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>