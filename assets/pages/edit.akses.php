<?php
session_start();
require '../config/php/backend.php';
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('akses ilegal');
    window.location='../'</script>";
    exit;
}
if (isset($_POST['add'])) {
    if (editakses($_POST) > 0) {
        echo "<script>
      alert('akses di rubah');
      document.location.href='./detail.akses.php';
      </script>
      ";
    }
}
$id = $_GET['id'];
$akses = query("SELECT * FROM akses WHERE id_akses = '$id'")[0];
$id_user = $akses['id_user'];
$user = query("SELECT * FROM user WHERE id = '$id_user'")[0];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../img/apple-icon.png">
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <title>
        JB Pay || Edit akses
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
                        <h3>Edit Akses</h3>
                        <form action="" class="mb-5" method="post" id="contactForm" enctype="multipart/form-data">
                            <div class=" row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="user" class="col-form-label">User :</label>
                                    <input name="id" value="<?= $akses['id_akses'] ?>" type="text" class="form-control d-none">
                                    <input disabled value="<?= $user['UserName'] ?> || <?= $user['Email'] ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mt-4 mb-4">
                                    <label for="event" class="col-form-label">Akses Event :</label>
                                    <select required class="form-control" name="event" id="event">
                                        <?php if ($akses['Event'] == "TRUE") { ?>
                                            <option selected value="TRUE">TRUE</option>
                                            <option value="FALSE">FALSE</option>
                                        <?php } else { ?>
                                            <option value="TRUE">TRUE</option>
                                            <option selected value="FALSE">FALSE</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group mt-4 mb-4">
                                    <label for="gallery" class="col-form-label">Akses Gallery :</label>
                                    <select required class="form-control" name="gallery" id="gallery">
                                        <?php if ($akses['Gallery'] == "TRUE") { ?>
                                            <option selected value="TRUE">TRUE</option>
                                            <option value="FALSE">FALSE</option>
                                        <?php } else { ?>
                                            <option value="TRUE">TRUE</option>
                                            <option selected value="FALSE">FALSE</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group mt-4 mb-4">
                                    <input type="submit" name="add" value="Edit Akses" class="btn btn-primary rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>
                        <footer>
                            <div class="d-flex justify-content-end warper">
                                <a href="./detail.akses.php">

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