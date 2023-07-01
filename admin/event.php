<?php
session_start();
error_reporting(0);
require "../assets/config/php/backend.php";
// kondisi
if (!isset($_SESSION['admin'])) {
  echo "<script>alert('akses ilegal');window.location='../'</script>";
  exit;
}
if (isset($_POST['ikut']) || isset($_POST['skip'])) {
  if (hadir($_POST) > 0) {
    echo "<script>
    alert('absen kehadiran')
    </script>
    ";
  }
}
if (isset($_POST['ubahtoskip']) || isset($_POST['ubahtoikut'])) {
  if (ubahhadir($_POST) > 0) {
    echo "<script>
    alert('absen kehadiran di ubah')
    </script>
    ";
  }
}
if (isset($_POST['hapus'])) {
  if (deleteevent($_POST) > 0) {
    echo "<script>
    alert('Event di hapus');
    </script>
    ";
  }
}
// query
$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE Email = '$email'")[0];
$lokasi = query("SELECT * FROM lokasi ORDER BY lokasi.Id_lokasi DESC")[0];
$idlokasi = $lokasi['Id_lokasi'];
$hadir = query("SELECT * FROM kehadiran INNER JOIN lokasi on kehadiran.Id_lokasi =lokasi.Id_lokasi INNER JOIN user USING(Email) WHERE kehadiran ='hadir' AND kehadiran.Id_lokasi = '$idlokasi'");
$skip = query("SELECT * FROM kehadiran INNER JOIN lokasi on kehadiran.Id_lokasi =lokasi.Id_lokasi INNER JOIN user USING(Email) WHERE kehadiran ='skip' AND kehadiran.Id_lokasi = '$idlokasi' ");
$querykehadiran = mysqli_query($konek, "SELECT * FROM kehadiran WHERE Id_lokasi = '$idlokasi' AND Email = '$email' ");
$Allkehadiran = query("SELECT * FROM kehadiran WHERE Id_lokasi = '$idlokasi' AND Email = '$email' ")[0];
$cekkehadiran = mysqli_num_rows($querykehadiran);
// logic
$fbiaya = number_format($lokasi['Biaya'], 0, ',', '.');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    JB Pay || Event
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
</head>

<body class="g-sidenav-show  bg-gray-200">
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
          <a class="nav-link active text-white bg-gradient-primary" href="./event.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">celebration</i>
            </div>
            <span class="nav-link-text ms-1">Event</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./profile.php">
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
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Event</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <button disabled class="btn btn-outline-primary btn-sm mb-0 me-3">10-desember-2023</button>
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
          <li class="nav-item dropdown pe-2 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell cursor-pointer"></i>
            </a>
            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
              <!-- notif -->
              <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="javascript:;">
                  <div class="d-flex py-1">
                    <div class="my-auto">
                      <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        <span class="font-weight-bold">New message</span> from Laur
                      </h6>
                      <p class="text-xs text-secondary mb-0">
                        <i class="fa fa-clock me-1"></i>
                        13 minutes ago
                      </p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="javascript:;">
                  <div class="d-flex py-1">
                    <div class="my-auto">
                      <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        <span class="font-weight-bold">New album</span> by Travis Scott
                      </h6>
                      <p class="text-xs text-secondary mb-0">
                        <i class="fa fa-clock me-1"></i>
                        1 day
                      </p>
                    </div>
                  </div>
                </a>
              </li>
              <!-- end isi notif -->
            </ul>
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
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xxl-7 col-xl-5 col-lg-5 mb-5">
          <div class="card pb-1 p-4">
            <div class="row">
              <div class="col-12">
                <h3 class="d-flex justify-content-center mt-3">Detail</h3>
              </div>
            </div>
            <hr class="dark horizontal mb-2 my-0">
            <div class="tabel d-flex justify-content-center mt-3 mb-4">
              <table style="font-size:larger">
                <input class="d-none" id="input-kota" type="text" value="<?= $lokasi['Daerah'] ?>">
                <tr>
                  <td>
                    <strong>Kegiatan</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td><?= $lokasi['Kegiatan'] ?></td>
                </tr>
                <tr class="mb-4">
                  <td>
                    <strong>Lokasi</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td class="mb-5"><?= $lokasi['Lokasi'] ?><sup id="sup-kota"></sup></td>
                  <br>
                </tr>
                <tr>
                  <td>
                    <strong>Suhu</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td id="suhu"></td>
                </tr>
                <tr>
                  <td>
                    <strong>Cuaca</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td id="cuaca"></td>
                </tr>
                <tr>
                  <td>
                    <strong>Tanggal</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td><?= $lokasi['tanggal'] ?></td>
                </tr>
                <tr>
                  <td>
                    <strong>Waktu</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td><?= $lokasi['waktu'] ?> WITA</td>
                </tr>
                <tr>
                  <td>
                    <strong>Titik Kumpul</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td><?= $lokasi['tikum'] ?></td>
                </tr>
                <tr>
                  <td>
                    <strong>Estimasi Biaya</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td data-bs-toggle="tooltip" data-bs-placement="left" title="per orang">Rp. <?= $fbiaya ?></td>
                </tr>
                <tr>
                  <td>
                    <strong>Dress Code</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td><?= $lokasi['dress'] ?></td>
                </tr>
                <tr>
                  <td>
                    <strong>Ikut</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td>
                    <div class="avatar-group">
                      <?php foreach ($hadir as $row) : ?>
                        <a class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $row['Nama'] ?>">
                          <img alt="Image placeholder" src="../assets/profile/<?= $row['gambar'] ?>">
                        </a>
                      <?php endforeach; ?>
                    </div>
                  </td>
                  <td>
                    <?php
                    if (!$cekkehadiran) {
                    ?>
                      <form method="POST" action="">
                        <input class="d-none" type="text" value="<?= $lokasi['Id_lokasi'] ?>" name="id_lokasi" id="">
                        <input class="d-none" type="text" value="<?= $email ?>" name="email" id="">
                        <input class="d-none" type="text" value="hadir" name="kehadiran" id="">
                        <button name="ikut" type="submit" style="border-radius: 5px;" class="btn btn-success">IKUT</button>
                      </form>
                    <?php
                    } elseif ($Allkehadiran['kehadiran'] == 'skip') {
                    ?>
                      <form method="POST" action="">
                        <input class="d-none" type="text" value="<?= $lokasi['Id_lokasi'] ?>" name="id_lokasi" id="">
                        <input class="d-none" type="text" value="<?= $email ?>" name="email" id="">
                        <input class="d-none" type="text" value="<?= $Allkehadiran['Id_kehadiran'] ?>" name="id" id="">
                        <input class="d-none" type="text" value="hadir" name="kehadiran" id="">
                        <button name="ubahtoikut" type="submit" style="border-radius: 5px;" class="btn btn-success">UBAH</button>
                      </form>
                    <?php
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Skip</strong>
                  </td>
                  <td>&nbsp;:&nbsp;&nbsp;</td>
                  <td>
                    <div class="avatar-group">
                      <?php foreach ($skip as $row) : ?>
                        <a class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $row['Nama'] ?>">
                          <img alt="Image placeholder" src="../assets/profile/<?= $row['gambar'] ?>">
                        </a>
                        <?php $i++; ?>
                      <?php endforeach; ?>
                    </div>
                  </td>
                  <td>
                    <?php
                    if (!$cekkehadiran) {
                    ?>
                      <form method="POST" action="">
                        <input class="d-none" type="text" value="<?= $lokasi['Id_lokasi'] ?>" name="id_lokasi" id="">
                        <input class="d-none" type="text" value="<?= $email ?>" name="email" id="">
                        <input class="d-none" type="text" value="skip" name="kehadiran" id="">
                        <button type="submit" name="skip" style="border-radius: 5px;" class="btn btn-danger">Skip</button>
                      </form>
                    <?php
                    } elseif ($Allkehadiran['kehadiran'] == 'hadir') {
                    ?>
                      <form method="POST" action="">
                        <input class="d-none" type="text" value="<?= $lokasi['Id_lokasi'] ?>" name="id_lokasi" id="">
                        <input class="d-none" type="text" value="<?= $email ?>" name="email" id="">
                        <input class="d-none" type="text" value="<?= $Allkehadiran['Id_kehadiran'] ?>" name="id" id="">
                        <input class="d-none" type="text" value="skip" name="kehadiran" id="">
                        <button name="ubahtoskip" type="submit" style="border-radius: 5px;" class="btn btn-danger">UBAH</button>
                      </form>
                    <?php
                    }
                    ?>
                  </td>
                </tr>
              </table>
            </div>
            <hr>
            <a style="margin-top: -10%" class="d-flex justify-content-end mb-5" href="../assets/pages/history.event.php">
              <i class=" material-icons opacity-100">history</i>
            </a>
          </div>
        </div>
        <div class=" col-xxl-5 col-xl-7 col-lg-7 mt-md-0 mt-sm-5">
          <div class="card">
            <div class="judul d-flex justify-content-center mt-3">
              <h3>Location</h3>
            </div>
            <hr class="dark horizontal mb-2 my-0">
            <div class="map d-flex justify-content-center ps-xxl-2 mb-4">
              <?= $lokasi['Map'] ?>
            </div>
          </div>
          <div class="card mt-3">
            <div class="judul d-flex justify-content-center mt-3">
              <h3>Action</h3>
            </div>
            <hr class="dark horizontal mb-2 my-0">
            <div class="row">
              <div class="col-4">
                <a class="ms-7" href="../assets/pages/add.event.php">
                  <button class="btn btn-primary mt-3 "><i class=" material-icons opacity-100">add</i></button>
                </a>
              </div>
              <div class="col-4">
                <a class="ms-5" href="../assets/pages/edit.event.php?id=<?= $lokasi['Id_lokasi'] ?>">
                  <button class="btn btn-warning mt-3"><i class=" material-icons opacity-100">edit</i></button>
                </a>
              </div>
              <div class="col-4">
                <form action="" method="post">
                  <input class="d-none" type="text" value="<?= $lokasi['Id_lokasi'] ?>" name="id">
                  <button onclick="return confirm('Yakin ingin menghapus event?')" type="submit" name="hapus" class="btn btn-danger mt-3"><i class=" material-icons opacity-100">delete</i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <?php require "../assets/pages/chat.php"; ?>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer py-4 mt-6">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
              ©
              <script>
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
  </main>
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
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <script src="../assets/config/js/cuaca.js"></script>
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
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>