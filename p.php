<?php
session_start();
$iduser = 4;
require 'assets/config/php/backend.php';
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('akses ilegal');
    window.location='../config/php/logout.php'</script>";
    exit;
}
if (isset($_POST['add'])) {
    if (adduser($_POST) > 0) {
        echo "<script>
      alert('Hutang di tambahkan');
      document.location.href='./detail.user.php?id=$iduser';
      </script>
      ";
    }
}
$lokasi = query("SELECT * FROM lokasi");
$user = query("SELECT * FROM user WHERE id = '$iduser' AND Email != 'gungnanda14@gmail.com' ")[0];
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
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round">
    <!--  -->
    <link rel="stylesheet" href="assets/pages/assets/fonts/icomoon/style.css">
    <link rel="stylesheet" href="assets/pages/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/pages/assets/css/style.css">
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row align-items-stretch no-gutters contact-wrap mb-5">
                <div class="col-md-12">
                    <div class="form h-100">
                        <h3>Add Pinjaman</h3>
                        <form action="" class="mb-5" method="post" id="contactForm" enctype="multipart/form-data">
                            <div class=" row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="lokasi" class="col-form-label">Nama User :</label>
                                    <input required class="form-control" type="text" value='<?= $user['Nama'] ?>' disabled>
                                    <input required class="form-control d-none" name="user" type="text" value='<?= $user['id'] ?>'>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="daerah" class="col-form-label">tempat & tanggal :</label>
                                    <select required class="form-control" name="lokasi" id="tipe">
                                        <option value="bkn">-Pilih tempat & tanggal-</option>
                                        <?php foreach ($lokasi as $row) : ?>
                                            <option value="<?= $row['Id_lokasi']; ?>"><?= $row['Lokasi']; ?> || <?= $row['tanggal']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group mb-3">
                                    <label for="tgl" class="col-form-label">Hutang</label>
                                    <input required autocomplete="off" type="Number" class="form-control" name="hutang" id="tgl" placeholder="Jumlah hutang">
                                </div>
                                <div class="col-md-4 form-group mb-3">
                                    <label for="waktu" class="col-form-label">Bayar</label>
                                    <input required autocomplete="off" type="Number" class="form-control" name="bayar" id="waktu" placeholder="berikan 0 jika tidak melakukan pembayaran">
                                </div>
                                <div class="col-md-4 form-group mb-3">
                                    <label for="waktu" class="col-form-label">Keterangan</label>
                                    <input required autocomplete="off" type="text" class="form-control" name="ket" id="waktu" placeholder="keterangan pembayaran">
                                </div>
                            </div>
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
                            <div class="file" class="row">
                                <div class="col-md-12 form-group mt-4 mb-4">
                                    <label for="bukti" class="col-form-label">Bukti Pembayaran :</label>
                                    <input accept=".IMG,.JPG,.JPEG,.PNG," required autocomplete="off" type="File" class="form-control" name="bukti" id="bukti">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="submit" name="add" value="Add Hutang" class="btn btn-primary rounded-0 py-2 px-4">
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
            <div class="row align-items-stretch no-gutters contact-wrap mb-5">
                <div class="col-md-12">
                    <div class="form h-100">
                        <h3>Add Pinjaman</h3>
                        <form action="" class="mb-5" method="post" id="contactForm" enctype="multipart/form-data">
                            <div class=" row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="lokasi" class="col-form-label">Nama User :</label>
                                    <input required class="form-control" type="text" value='<?= $user['Nama'] ?>' disabled>
                                    <input required class="form-control d-none" name="user" type="text" value='<?= $user['id'] ?>'>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="daerah" class="col-form-label">tempat & tanggal :</label>
                                    <select required class="form-control" name="lokasi" id="tipe">
                                        <option value="bkn">-Pilih tempat & tanggal-</option>
                                        <?php foreach ($lokasi as $row) : ?>
                                            <option value="<?= $row['Id_lokasi']; ?>"><?= $row['Lokasi']; ?> || <?= $row['tanggal']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group mb-3">
                                    <label for="tgl" class="col-form-label">Hutang</label>
                                    <input required autocomplete="off" type="Number" class="form-control" name="hutang" id="tgl" placeholder="Jumlah hutang">
                                </div>
                                <div class="col-md-4 form-group mb-3">
                                    <label for="waktu" class="col-form-label">Bayar</label>
                                    <input required autocomplete="off" type="Number" class="form-control" name="bayar" id="waktu" placeholder="berikan 0 jika tidak melakukan pembayaran">
                                </div>
                                <div class="col-md-4 form-group mb-3">
                                    <label for="waktu" class="col-form-label">Keterangan</label>
                                    <input required autocomplete="off" type="text" class="form-control" name="ket" id="waktu" placeholder="keterangan pembayaran">
                                </div>
                            </div>
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
                            <div class="file" class="row">
                                <div class="col-md-12 form-group mt-4 mb-4">
                                    <label for="bukti" class="col-form-label">Bukti Pembayaran :</label>
                                    <input accept=".IMG,.JPG,.JPEG,.PNG," required autocomplete="off" type="File" class="form-control" name="bukti" id="bukti">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="submit" name="add" value="Add Hutang" class="btn btn-primary rounded-0 py-2 px-4">
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


    <script src="assets/pages/assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/pages/assets/js/popper.min.js"></script>
    <script src="assets/pages/assets/js/bootstrap.min.js"></script>
    <script src="assets/pages/assets/js/jquery.validate.min.js"></script>
    <script>
        const file = document.querySelector('.file');
        const inputF = document.getElementById('bukti')

        function Hilang() {
            file.classList.add('d-none');
            inputF.removeAttribute('required');
        }

        function tambah() {
            file.classList.remove('d-none');
            inputF.setAttribute('required', '');
        }
    </script>
</body>

</html>