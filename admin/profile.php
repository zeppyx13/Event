<?php
error_reporting(0);
session_start();
require "../assets/config/php/backend.php";
if (!isset($_SESSION['admin'])) {
  echo "<script>alert('akses ilegal');
  window.location='../assets/config/php/logout.php'</script>";
  exit;
}
if (isset($_POST['login'])) {
  if (Uprofile($_POST) > 0) {
    echo "<script>
    alert('profile di ubah')
    </script>
    ";
  }
}
$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE Email = '$email'")[0];
$season = query("SELECT * FROM deadline ORDER BY season DESC")[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    JB Pay || Profile
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">JB Pay</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="./">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./gallery.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">photo_library</i>
            </div>
            <span class="nav-link-text ms-1">Gallery</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="./event.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">celebration</i>
            </div>
            <span class="nav-link-text ms-1">Event</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./topup.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">diamond</i>
            </div>
            <span class="nav-link-text ms-1">Top Up</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white bg-gradient-primary activce" href="./profile.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../assets/config/php/logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">logout</i>
            </div>
            <span class="nav-link-text ms-1">Sign Out</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Profile</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class=" ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <button class="btn btn-outline-primary btn-sm mb-0 me-3">Season <?= $season['season'] ?> : <?= $season['tanggal'] ?>-<?= $season['bulan'] ?>-<?= $season['tahun'] ?></button>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li style="margin-left: 20px;" class="nav-item d-flex align-items-center">
              <a href="./profile.php">
                <img style="max-height:40px; border-radius:50%; margin-right:10px;" src="../assets/profile/<?= $user['gambar'] ?>" alt="profile">
              </a>
              <span class="d-sm-inline d-none"><?= $user['UserName'] ?></span>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <a href="../assets/profile/<?= $user['gambar'] ?>">
                <img src="../assets/profile/<?= $user['gambar'] ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
              </a>
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?= $user['Nama'] ?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                <?= $user['UserName'] ?>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" role="tab" aria-selected="true">
                    <i class="material-icons text-lg position-relative">settings</i>
                    <span class="ms-1">Settings</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-xl-8">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Account Settings</h6>
              </div>
              <div class="card-body p-3">
                <form action="" method="post" role="form" class="text-start" enctype="multipart/form-data">
                  <div class="row">
                    <input type="text" class="d-none" name="id" value="<?= $user['id'] ?>">
                    <input type="text" class="d-none" name="oldgambar" value="<?= $user['gambar'] ?>">
                    <div class="col-6">
                      <div class="input-group input-group-outline my-3">
                        <input disabled value="<?= $user['Email'] ?>" required autocomplete="off" name="email" type="email" class="form-control">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="input-group input-group-outline my-3">
                        <input value="<?= $user['Nama'] ?>" placeholder="Nama" required autocomplete="off" name="nama" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="input-group input-group-outline my-3">
                        <input required placeholder="Username" autocomplete="off" name="username" value="<?= $user['UserName'] ?>" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="input-group input-group-outline my-3">
                        <input accept=".IMG,.JPG,.JPEG,.PNG," autocomplete="off" name="img" type="file" class="form-control">
                      </div>
                    </div>
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Password Settings</h6>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Old Password </label>
                        <input id="pw" autocomplete="off" name="passwordold" type="password" class="form-control">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">New Password</label>
                        <input id="pw2" autocomplete="off" name="pw1" type="password" class="form-control">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Re-enter new pw</label>
                        <input id="pw3" autocomplete="off" name="pw2" type="password" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-1 col-1">
                      <i class="ms-2 mt-4 material-icons opacity-10" id="iconpw">visibility</i>
                    </div>
                  </div>
                  <div class="text-center">
                    <button onclick="return confirm('Yakin mengubah Profile?')" name="login" type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Change Profile</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Tool's</h6>
              </div>
              <div class="card-body p-3">
                <ul class="list-group">
                  <a href="../assets/pages/detail.season.php">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                      <button class="btn btn-facebook  w-100 my-4 mb-2"><i class="material-icons opacity-100">schedule</i> SEASON</button>
                    </li>
                  </a>
                  <a href="../assets/pages/detail.profile.php">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                      <button class="btn btn-vimeo  w-100 my-4 mb-2"><i class="material-icons opacity-100">group</i> User</button>
                    </li>
                  </a>
                  <a href="../assets/pages/detail.akses.php">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                      <button class="btn btn-warning  w-100 my-4 mb-2"><i class="material-icons opacity-100">key</i> Access</button>
                    </li>
                  </a>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://gungnanda.com" class="font-weight-bold" target="_blank">Gung Nanda</a>
                for a better web.
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- seting ui -->
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">UI Configurator</h5>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Pilih antara 2 jenis sidenav yang berbeda.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    let iconpw = document.getElementById("iconpw");
    let pw = document.getElementById("pw");
    let pw2 = document.getElementById("pw2");
    let pw3 = document.getElementById("pw3");
    iconpw.onclick = function() {
      if (pw.type == "password") {
        pw.type = "text";
        pw2.type = "text";
        pw3.type = "text";
        iconpw.innerHTML = "visibility_off"
      } else {
        pw.type = "password"
        pw2.type = "password"
        pw3.type = "password"
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
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>