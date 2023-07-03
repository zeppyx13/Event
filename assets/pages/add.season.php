<?php
session_start();
require '../config/php/backend.php';
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('akses ilegal');
    window.location='../'</script>";
    exit;
}
if (isset($_POST['add'])) {
    if (addseason($_POST) > 0) {
        echo "<script>
      alert('SEASON di tambahkan');
      document.location.href='./detail.season.php';
      </script>
      ";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../img/apple-icon.png">
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <title>
        JB Pay || Add Season
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../css/nucleo-icons.css" rel="stylesheet" />
    <link href="../css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round">
    <!--  -->
    <link rel="stylesheet" href="assets/fonts/icomoon/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row align-items-stretch no-gutters contact-wrap">
                <div class="col-md-12">
                    <div class="form h-100">
                        <h3>Add SEASON</h3>
                        <form action="" class="mb-5" method="post" id="contactForm" enctype="multipart/form-data">
                            <div class=" row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="nama" class="col-form-label">Season ke- :</label>
                                    <input required autocomplete="off" id="nama" class="form-control" type="number" name="season" placeholder="Masukan Season sekarang">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group mt-4 mb-4">
                                    <label for="tgl" class="col-form-label">Tanggal :</label>
                                    <input required autocomplete="off" type="Number" class="form-control" name="tgl" id="tgl">
                                </div>
                                <div class="col-md-4 form-group mt-4 mb-4">
                                    <label for="bulan" class="col-form-label">Bulan :</label>
                                    <select required class="form-control" name="bulan" id="bulan">
                                        <option value="bkn">-Pilih Bulan-</option>
                                        <option value="JANUARI">JAN</option>
                                        <option value="FEBRUARI">FEB</option>
                                        <option value="MARET">MAR</option>
                                        <option value="APRIL">APR</option>
                                        <option value="MEI">MEI</option>
                                        <option value="JUNI">JUN</option>
                                        <option value="JULI">JUL</option>
                                        <option value="AGUSTUS">AUG</option>
                                        <option value="SEPTEMBER">SEP</option>
                                        <option value="OKTOBER">OKT</option>
                                        <option value="NOVEMBER">NOV</option>
                                        <option value="DESEMBER">DES</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group mt-4 mb-4">
                                    <label for="tahun" class="col-form-label">Tahun :</label>
                                    <input required autocomplete="off" type="number" class="form-control" name="tahun" id="tahun">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group mt-4 mb-4">
                                    <input type="submit" name="add" value="Add Season" class="btn btn-primary rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>
                        <footer>
                            <div class="d-flex justify-content-end warper">
                                <a href="./detail.season.php">

                                    <h4>
                                        <<< </h1>
                                </a>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
</body>

</html>