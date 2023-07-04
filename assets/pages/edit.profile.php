<?php
session_start();
require "../config/php/backend.php";
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('akses ilegal');
    window.location='../config/php/logout.php'</script>";
    exit;
}
if (isset($_POST['login'])) {
    if (Uprofileadmin($_POST) > 0) {
        echo "<script>
    alert('profile di ubah')
    </script>
    ";
    }
}
$id = $_GET['id'];
$user = query("SELECT * FROM user WHERE id = '$id'")[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../img/apple-icon.png">
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <title>
        JB Pay || Edit Profile
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
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show bg-gray-200">
    <div class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a class="opacity-5 text-dark" href="../../admin/profile.php">Profile</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a class="opacity-5 text-dark" href="./detail.profile.php">User</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit User</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Edit User</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class=" ms-md-auto pe-md-3 d-flex align-items-center">

                    </div>
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
                            <a href="../profile/<?= $user['gambar'] ?>">
                                <img src="../profile/<?= $user['gambar'] ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
                                <a href="./detail.profile.php" class="nav-link mb-0 px-0 py-1 active ">
                                    <li class="nav-item">
                                        <i class="material-icons text-lg position-relative">keyboard_return</i>
                                        <span class="ms-1">Back</span>
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-12">
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
                                                <select required class="form-control" name="role" id="bulan">
                                                    <?php
                                                    if ($user['lvl'] == "admin") {
                                                    ?>
                                                        <option selected value="admin">ADMIN</option>
                                                        <option value="user">USER</option>
                                                    <?php } else { ?>
                                                        <option value="admin">ADMIN</option>
                                                        <option selected value="user">USER</option>
                                                    <?php } ?>
                                                </select>
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
                                        <div class="card-header pb-0 p-3">
                                            <h6 class="mb-0">Password Settings</h6>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-outline my-3">
                                                <input id="pw2" autocomplete="off" name="pw1" type="password" class="form-control" placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-group input-group-outline my-3">
                                                <input id="pw3" autocomplete="off" name="pw2" type="password" class="form-control" placeholder="Re-enter new pw">
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
    <!--   Core JS Files   -->
    <script src="../js/core/popper.min.js"></script>
    <script src="../js/core/bootstrap.min.js"></script>
    <script src="../js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../js/plugins/smooth-scrollbar.min.js"></script>
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
    <script src="../js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>