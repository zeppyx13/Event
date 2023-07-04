<?php
session_start();
require '../config/php/backend.php';
// akses
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('akses ilegal');
    window.location='../config/php/logout.php'</script>";
    exit;
}
$id = $_GET['id'];
$event = query("SELECT * FROM lokasi WHERE Id_lokasi = '$id'")[0];
if (isset($_POST['add'])) {
    if (updateevent($_POST) > 0) {
        echo "<script>
      alert('Event di rubah');
      document.location.href='../../admin/event.php';
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
                            <input class="d-none" type="text" name="id" value="<?= $event['Id_lokasi'] ?>">
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="lokasi" class="col-form-label">Lokasi:</label>
                                    <input value="<?= $event['Lokasi'] ?>" required autocomplete="off" type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Masukan lokasi tujuan event">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="daerah" class="col-form-label">Daerah :</label>
                                    <input value="<?= $event['Daerah'] ?>" required autocomplete="off" type="text" class="form-control" name="daerah" id="daerah" placeholder="Masukan daerah lokasi event contoh: gianyar/denpasar/badung..dll">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="tgl" class="col-form-label">Tanggal</label>
                                    <input value="<?= $event['tanggal'] ?>" required autocomplete="off" type="Date" class="form-control" name="tgl" id="tgl" placeholder="Your name">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="waktu" class="col-form-label">Waktu</label>
                                    <input value="<?= $event['waktu'] ?>" required autocomplete="off" type="time" class="form-control" name="waktu" id="waktu">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group mb-3">
                                    <label for="biaya" class="col-form-label">Biaya/orang :</label>
                                    <input value="<?= $event['Biaya'] ?>" required autocomplete="off" type="number" class="form-control" name="biaya" id="biaya" placeholder="Perkiraan biaya/orang">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label for="tikum" class="col-form-label">Titik Kumpul :</label>
                                    <input value="<?= $event['tikum'] ?>" required autocomplete="off" type="text" class="form-control" name="tikum" id="tikum" placeholder="Titik kumpul keberangkatan">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label for="dress" class="col-form-label">Dress Code :</label>
                                    <input value="<?= $event['dress'] ?>" required autocomplete="off" type="text" class="form-control" name="dress" id="dress" placeholder="dress code yang di gunakan default (-)" value="-">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label for="kegiatan" class="col-form-label">Kegiatan :</label>
                                    <input value="<?= $event['Kegiatan'] ?>" required autocomplete="off" type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="kegiatan ytang di lakukan">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="message" class="col-form-label">Link Google Map</label>
                                    <textarea required autocomplete="off" class="form-control" name="link" id="message" cols="30" rows="4" placeholder="Link embed (sematkan peta) pada Google Map."><?= $event['Map'] ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="submit" name="add" value="Update Event" class="btn btn-primary rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>
                        <footer>
                            <div class="d-flex justify-content-end warper">
                                <a href="../../admin/event.php">

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