<?php
error_reporting(0);
session_start();
require "../assets/config/php/backend.php";
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('akses ilegal');
  window.location='../assets/config/php/logout.php'</script>";
    exit;
}
$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE Email = '$email'")[0];
$season = query("SELECT * FROM deadline ORDER BY season DESC")[0];
$users = query("SELECT * FROM user WHERE Email != 'gungnanda14@gmail.com'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        JB Pay || LeaderBoard
    </title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" target="_blank">
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
                    <a class="nav-link text-white active bg-gradient-primary" href="./leaderboard.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">leaderboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Leader Board</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./gallery.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">photo_library</i>
                        </div>
                        <span class="nav-link-text ms-1">Gallery</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="./event.php">
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Leader Board</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                </nav>
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
                    </li>
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
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="d-flex justify-content-start text-white text-capitalize ps-3"><i class="material-icons opacity-10">leaderboard</i> Leader Board</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div id="container" class=" table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-black  text-center font-weight-bolder">RANK</th>
                                            <th class="text-black font-weight-bolder"></th>
                                            <th class="text-black font-weight-bolder"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="leaderboard" class="container">
                                        <tr>
                                            <!-- scores will be inserted by the script here -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
        let scores = [
            <?php $i = 1; ?>
            <?php foreach ($users as $row) : ?>
                <?php
                $id =  $row['id'];
                $qhutang = query("SELECT SUM(hutang) AS TotalP,SUM(bayar) AS TotalB FROM hutang WHERE Id_user = $id")[0];
                ?> {
                    img: "<?= $row['gambar'] ?>",
                    name: "<?= $row['UserName'] ?>",
                    score: <?= $qhutang['TotalP'] - $qhutang['TotalB'] ?>
                },
                <?php $i++; ?>
            <?php endforeach; ?>
        ];

        function updateLeaderboardView() {
            let leaderboard = document.getElementById("leaderboard");
            leaderboard.innerHTML = "";

            scores.sort(function(a, b) {
                return b.score - a.score
            });
            let elements = []; // we'll need created elements to update colors later on
            // create elements for each player
            for (let i = 0; i < scores.length; i++) {
                console.log(i);
                let rank = document.createElement("td");
                let name = document.createElement("td");
                let imgcover = document.createElement("td");
                let score = document.createElement("td");
                let img = document.createElement("img");
                rank.classList.add("rank", "text-center", "text-black");
                name.classList.add("name", "text-black");
                score.classList.add("score", "text-black", "d-none");
                rank.innerText = i + 1;
                img.src = "../assets/profile/" + scores[i].img;
                img.alt = scores[i].name;
                img.width = 50;
                img.height = 50;
                imgcover.appendChild(img);
                name.innerText = scores[i].name;
                score.innerText = scores[i].score;

                let scoreRow = document.createElement("tr");
                scoreRow.appendChild(rank);
                scoreRow.appendChild(imgcover);
                scoreRow.appendChild(name);
                scoreRow.appendChild(score);
                leaderboard.appendChild(scoreRow);

                elements.push(scoreRow);

            }

            let colors = ["gold", "silver", "#cd7f32"];
            for (let i = 0; i < 3; i++) {
                elements[i].style.backgroundColor = colors[i];
                elements[i].style.fontWeight = "Bold";
                elements[i].style.color = "BLACK";

            }
        }

        updateLeaderboardView();
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