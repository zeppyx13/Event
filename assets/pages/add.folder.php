<?php
error_reporting(0);
session_start();
require '../config/php/backend.php';
// akses
$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE Email = '$email'")[0];
$id_user = $user['id'];
$akses = query("SELECT * FROM akses WHERE id_user = '$id_user'")[0];
if (!isset($_SESSION['admin']) && $akses['Gallery'] == 'FALSE') {
    echo "<script>alert('akses ilegal');
    window.location='../config/php/logout.php'</script>";
    exit;
}
if (isset($_POST['add'])) {
    if (addfolder($_POST) > 0) {
        if ($akses['Gallery'] == 'TRUE') {
            echo "<script>
            alert('Folder di tambahkan');
            document.location.href='../../dashboard/gallery.php';
            </script>
            ";
        } else {
            echo "<script>
            alert('Folder di tambahkan');
            document.location.href='../../admin/gallery.php';
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
        JB Pay || Add Folder
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
                        <h3>Add Folder</h3>
                        <form action="" class="mb-5" method="post" id="contactForm" enctype="multipart/form-data">
                            <div class=" row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="nama" class="col-form-label">Nama Folder :</label>
                                    <input required autocomplete="off" id="nama" class="form-control" type="text" name="nama" placeholder="Masukan Nama Folder Sesuai Dengan Google Drive">
                                </div>
                            </div>
                            <div class="file" class="row">
                                <div class="col-md-12 form-group mt-4 mb-4">
                                    <label for="foto" class="col-form-label">Link G Drive :</label>
                                    <input required autocomplete="off" type="url" class="form-control" name="link" id="foto" placeholder="Masukan Link Folder Dengan Google Drive">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group mt-4 mb-4">
                                    <input type="submit" name="add" value="Add Folder" class="btn btn-primary rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>
                        <footer>
                            <div class="d-flex justify-content-end warper">
                                <a <?php if ($akses['Gallery'] == 'TRUE') {
                                        echo "href='../../dashboard/gallery.php'";
                                    } else {
                                        echo "href='../../admin/gallery.php'";
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