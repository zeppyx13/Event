<?php
session_start();
require '../config/php/backend.php';
error_reporting(0);
$query = query("SELECT * FROM user");
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('akses ilegal');
    window.location='../config/php/logout.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../img/apple-icon.png">
    <link rel="icon" type="image/pn g" href="../img/favicon.png">
    <title>
        JB Pay || Detail User
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

<body class="g-sidenav-show  bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a class="opacity-5 text-dark" href="../../admin/">Dashboard</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">User</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">User Detail</h6>
                </nav>
            </div>
            </div>
        </nav>
        <!-- Navbar -->
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <!-- real -->
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Detail User<a class="text-white text-capitalize" style="margin-left:80%" href="../../admin/profile.php">BACK</a></h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div id="container" class=" table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-black font-weight-bolder">No</th>
                                            <th class="text-center text-black font-weight-bolder">Role</th>
                                            <th class="text-center text-uppercase text-black font-weight-bolder">Nama</th>
                                            <th class="text-center text-uppercase text-black font-weight-bolder">User Name</th>
                                            <th class="text-center text-uppercase text-black font-weight-bolder">Email</th>
                                            <th class="text-center text-uppercase text-black font-weight-bolder">Profile</th>
                                            <th class="text-center text-uppercase text-black font-weight-bolder">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($query as $row) : ?>
                                            <tr>
                                                <td class="text-center text-black"><?= $i ?></td>
                                                <td class="text-center text-black"><?= $row['lvl'] ?></td>
                                                <td class="text-center text-black"><?= $row['Nama'] ?></td>
                                                <td class="text-center text-black"><?= $row['UserName'] ?></td>
                                                <td class="text-center text-black"><?= $row['Email'] ?></td>
                                                <td class="text-center text-black">
                                                    <div class="avatar avatar-xl position-relative">
                                                        <a href="../profile/<?= $row['gambar'] ?>">
                                                            <img src="../profile/<?= $row['gambar'] ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center text-black">
                                                    <a href="./edit.profile.php?id=<?= $row['id'] ?>"><i class=" material-icons opacity-100">edit</i></a>
                                                    <a onclick="return confirm('Yakin ingin menghapus User?')" href="./delete.profile.php?id=<?= $row['id'] ?>"><i class=" material-icons opacity-100">delete</i></a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                                for a better web.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <!-- seting ui -->
    <!--   Core JS Files   -->
    <script src="../js/core/popper.min.js"></script>
    <script src="../js/core/bootstrap.min.js"></script>
    <script src="../js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../js/plugins/smooth-scrollbar.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="../config/js/user.js"></script>
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