<?php
session_start();
require '../config/php/backend.php';
$id = $_GET['id'];
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('akses ilegal');
    window.location='../config/php/logout.php'</script>";
    exit;
}
$userquery = query("SELECT * FROM hutang WHERE Id_hutang ='$id'")[0];
$idtempat = $userquery['Id_tempat'];
$iduser = $userquery['Id_user'];
$lokasisblm = query("SELECT * FROM lokasi WHERE Id_lokasi = '$idtempat'")[0];
$usersblm = query("SELECT * FROM user WHERE id = '$iduser'")[0];
$lokasi = query("SELECT * FROM lokasi WHERE Id_lokasi != '$idtempat'");
if (isset($_POST['add'])) {
    if (edituser($_POST) > 0) {
        echo "<script>
      alert('Pinjaman di rubah');
      document.location.href='./detail.user.php?id=$iduser';
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
        JB Pay || Add User
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
                        <h3>Edit Pinjaman</h3>
                        <form action="" class="mb-5" method="post" id="contactForm" enctype="multipart/form-data">
                            <input class="d-none" type="text" value="<?= $id ?>" name="id">
                            <div class=" row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="lokasi" class="col-form-label">User :</label>
                                    <input required autocomplete="off" type="text" class="form-control" id="tgl" placeholder="Jumlah hutang" value="<?= $usersblm['Nama'] ?>" disabled>
                                    <input required autocomplete="off" type="text" class="d-none form-control" name="user" id="tgl" placeholder="Jumlah hutang" value="<?= $usersblm['id'] ?>">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="daerah" class="col-form-label">tempat & tanggal :</label>
                                    <select required class="form-control" name="lokasi" id="tipe">
                                        <option value="<?= $lokasisblm['Id_lokasi']; ?>"><?= $lokasisblm['Lokasi']; ?> || <?= $lokasisblm['tanggal']; ?></option>
                                        <?php foreach ($lokasi as $row) : ?>
                                            <option value="<?= $row['Id_lokasi']; ?>"><?= $row['Lokasi']; ?> || <?= $row['tanggal']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group mb-3">
                                    <label for="tgl" class="col-form-label">Hutang</label>
                                    <input required autocomplete="off" type="Number" class="form-control" name="hutang" id="tgl" placeholder="Jumlah hutang" value="<?= $userquery['hutang'] ?>">
                                </div>
                                <div class="col-md-4 form-group mb-3">
                                    <label for="waktu" class="col-form-label">Bayar</label>
                                    <input required autocomplete="off" type="Number" class="form-control" name="bayar" id="waktu" placeholder="berikan 0 jika tidak melakukan pembayaran" value="<?= $userquery['bayar'] ?>">
                                </div>
                                <div class="col-md-4 form-group mb-3">
                                    <label for="waktu" class="col-form-label">Keterangan</label>
                                    <input required autocomplete="off" type="text" class="form-control" name="ket" id="waktu" placeholder="keterangan pembayaran" value="<?= $userquery['keterangan'] ?>">
                                </div>
                            </div>
                            <?php
                            if ($userquery['bukti'] == NULL) {
                            ?>
                                <div class="row">
                                    <div class="col-md-12 form-group mt-4 mb-4">
                                        <label for="waktu" class="col-form-label">Pembayaran? :</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode" id="exampleRadios4" onclick="tambah()" value="ada">
                                            <label class="form-check-label" for="exampleRadios4">
                                                Ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="radio" name="metode" id="exampleRadios5" onclick="Hilang()" value="gk">
                                            <label class="form-check-label" for="exampleRadios5">
                                                Tidak ada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="file row d-none">
                                    <div class="col-md-12 form-group mt-4 mb-4">
                                        <label for="bukti" class="col-form-label">Bukti Pembayaran :</label>
                                        <input autocomplete="off" type="File" class="form-control" accept=".IMG,.JPG,.JPEG,.HEIC,.PNG" name="bukti" id="bukti">
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col-md-12 form-group mt-4 mb-4">
                                        <label for="waktu" class="col-form-label">Pembayaran? :</label>
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="radio" name="metode" id="exampleRadios4" onclick="tambah()" value="ada">
                                            <label class="form-check-label" for="exampleRadios4">
                                                Ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode" id="exampleRadios5" onclick="Hilang()" value="gk">
                                            <label class="form-check-label" for="exampleRadios5">
                                                Tidak ada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="file row">
                                    <input class="d-none" type="text" name="buktiold" value="<?= $userquery['bukti'] ?>">
                                    <div class="col-md-4 form-group mt-4 d-flex justify-content-center">
                                        <a href="../bukti/<?= $userquery['bukti'] ?>" target="_blank" rel="noopener noreferrer"><img style="max-width: 70%; max-height:100%;" src="../bukti/<?= $userquery['bukti'] ?>" alt=""></a>
                                    </div>
                                    <div class="col-md-8 form-group mt-3">
                                        <label for="bukti" class="col-form-label">Bukti Pembayaran :</label>
                                        <input accept=".IMG,.JPG,.JPEG,.PNG," autocomplete="off" type="File" class="form-control" name="bukti" id="bukti">
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-12 mt-5 form-group">
                                    <input type="submit" name="add" value="Edit Pinjaman" class="btn btn-primary rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>
                        <footer>
                            <div class="d-flex justify-content-end warper">
                                <a href="./detail.user.php?id=<?= $iduser ?>">

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
    <script>
        const file = document.querySelector('.file');
        const inputF = document.getElementById('bukti')

        function Hilang() {
            file.classList.add('d-none');
        }

        function tambah() {
            file.classList.remove('d-none');
        }
    </script>
</body>

</html>