<?php
error_reporting(0);
session_start();
require '../config/php/backend.php';
// akses
$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE Email = '$email'")[0];
$id_user = $user['id'];
$akses = query("SELECT * FROM akses WHERE id_user = '$id_user'")[0];
if (!isset($_SESSION['admin']) && $akses['Event'] == 'FALSE') {
    echo "<script>alert('akses ilegal');
    window.location='../config/php/logout.php'</script>";
    exit;
}
if (isset($_POST['add'])) {
    if (addevent($_POST) > 0) {
        if ($akses['Event'] == 'TRUE') {
            echo "<script>
            alert('Event di tambahkan');
            document.location.href='../../dashboard/event.php';
            </script>
            ";
        } else {
            echo "<script>
            alert('Event di tambahkan');
            document.location.href='../../admin/event.php';
            </script>
            ";
        }
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
        JB Pay || Add Event
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
                        <h3>Add Event</h3>
                        <form action="" class="mb-5" method="post" id="contactForm">
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="lokasi" class="col-form-label">Lokasi:</label>
                                    <input required autocomplete="off" type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Masukan lokasi tujuan event">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="daerah" class="col-form-label">Daerah :</label>
                                    <input required autocomplete="off" type="text" class="form-control" name="daerah" id="daerah" placeholder="Masukan daerah lokasi event contoh: gianyar/denpasar/badung..dll">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="tgl" class="col-form-label">Tanggal</label>
                                    <input required autocomplete="off" type="Date" class="form-control" name="tgl" id="tgl" placeholder="Your name">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="waktu" class="col-form-label">Waktu</label>
                                    <input required autocomplete="off" type="time" class="form-control" name="waktu" id="waktu">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group mb-3">
                                    <label for="biaya" class="col-form-label">Biaya/orang :</label>
                                    <input required autocomplete="off" type="number" class="form-control" name="biaya" id="biaya" placeholder="Perkiraan biaya/orang">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label for="tikum" class="col-form-label">Titik Kumpul :</label>
                                    <input required autocomplete="off" type="text" class="form-control" name="tikum" id="tikum" placeholder="Titik kumpul keberangkatan">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label for="dress" class="col-form-label">Dress Code :</label>
                                    <input required autocomplete="off" type="text" class="form-control" name="dress" id="dress" placeholder="dress code yang di gunakan default (-)" value="-">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label for="kegiatan" class="col-form-label">Kegiatan :</label>
                                    <input required autocomplete="off" type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="kegiatan yang di lakukan">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="message" class="col-form-label">Link Google Map</label>
                                    <textarea required autocomplete="off" class="form-control" name="link" id="message" cols="30" rows="4" placeholder="Link embed (sematkan peta) pada Google Map."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="submit" name="add" value="Add Event" class="btn btn-primary rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>
                        <footer>
                            <div class="d-flex justify-content-end warper">
                                <a <?php if ($akses['Event'] == 'TRUE') {
                                        echo "href='../../dashboard/Event.php'";
                                    } else {
                                        echo "href='../../admin/Event.php'";
                                    }; ?>>

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