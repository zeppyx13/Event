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
$fototransaksi = query("SELECT DISTINCT transaksi FROM hutang WHERE transaksi != '' ");
$fotobukti = query("SELECT DISTINCT bukti FROM hutang WHERE bukti != ''");
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
                            <?php if ($userquery['bukti'] == NULL && $userquery['transaksi'] == NULL) { ?>
                                <div class="row">
                                    <div class="col-md-6 form-group mt-4 mb-4">
                                        <label for="waktu" class="col-form-label">Bukti Pembayaran? :</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode" id="exampleRadios1" onclick="tambah()" value="ada">
                                            <label class="form-check-label" for="exampleRadios1">
                                                Ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="radio" name="metode" id="exampleRadios2" onclick="Hilang()" value="gk">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Tidak ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode" id="exampleRadios3" onclick="old()" value="old">
                                            <label class="form-check-label" for="exampleRadios3">
                                                Foto Yang Sama
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mt-4 mb-4">
                                        <label for="waktu" class="col-form-label">Bukti Transaksi :</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transaksi" id="exampleRadios4" onclick="tambah_transaksi()" value="ada">
                                            <label class="form-check-label" for="exampleRadios4">
                                                Ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="radio" name="transaksi" id="exampleRadios5" onclick="Hilang_transaksi()" value="gk">
                                            <label class="form-check-label" for="exampleRadios5">
                                                Tidak ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transaksi" id="exampleRadios6" onclick="old_transaksi()" value="old">
                                            <label class="form-check-label" for="exampleRadios6">
                                                Foto Yang Sama
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- upload bukti pembayaran -->
                                    <div class="file col-md-6 form-group d-none">
                                        <label for="bukti" class="col-form-label">
                                            <h6>Bukti Pembayaran :</h6>
                                        </label>
                                        <input accept=".IMG,.JPG,.JPEG,.PNG," required autocomplete="off" type="File" class="form-control" name="bukti" id="bukti">
                                    </div>
                                    <!--  -->
                                    <!-- foto bukti pembayaran -->
                                    <div class="old_bukti col-md-6 form-group  d-none">
                                        <label for="waktu" class="col-form-label">
                                            <h6?>Foto Bukti Pembayaran :</h6>
                                        </label>
                                        <?php foreach ($fotobukti as $row) : ?>
                                            <div class="form-check">
                                                <input checked class="foto_bukti form-check-input" type="radio" name="old_bukti" id="<?= $row['bukti']; ?>" value="<?= $row['bukti']; ?>">
                                                <label class="form-check-label m-4" for="<?= $row['bukti']; ?>">
                                                    <img src="../bukti/<?= $row['bukti']; ?>" alt="<?= $row['bukti']; ?>" width="100" height="100">
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!--  -->
                                    <!-- upload file transaksi -->
                                    <div class="file_transaksi col-md-6 form-group d-none">
                                        <label for="bukti" class="col-form-label">
                                            <h6>Bukti Transaksi :</h6>
                                        </label>
                                        <input accept=".IMG,.JPG,.JPEG,.PNG," required autocomplete="off" type="File" class="form-control" name="bukti_transaksi" id="bukti_transaksi">
                                    </div>
                                    <!--  -->
                                    <!-- foto bukti transaksi -->
                                    <div class="old_transaksi col-md-6 form-group d-none">
                                        <label for="waktu" class="col-form-label">
                                            <h6>Foto Bukti Transaksi :</h6>
                                        </label>
                                        <?php foreach ($fototransaksi as $row) : ?>
                                            <div class="form-check">
                                                <input checked class="foto_lama form-check-input" type="radio" name="old_transaki" id="<?= $row['transaksi']; ?>" value="<?= $row['transaksi']; ?>">
                                                <label class="form-check-label m-4" for="<?= $row['transaksi']; ?>">
                                                    <a href="../bukti_transaksi/<?= $row['transaksi']; ?>" target="_blank" rel="noopener noreferrer"><img src="../bukti_transaksi/<?= $row['transaksi']; ?>" alt="" width="100" height="100"></a>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!--  -->
                                </div>
                            <?php } elseif ($userquery['bukti'] != NULL && $userquery['transaksi'] == NULL) { ?>
                                <div class="row">
                                    <div class="col-md-6 form-group mt-4 mb-4">
                                        <label for="waktu" class="col-form-label">Bukti Pembayaran? :</label>
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="radio" name="metode" id="exampleRadios1" onclick="tambah()" value="ada">
                                            <label class="form-check-label" for="exampleRadios1">
                                                Ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode" id="exampleRadios2" onclick="Hilang()" value="gk">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Tidak ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode" id="exampleRadios3" onclick="old()" value="old">
                                            <label class="form-check-label" for="exampleRadios3">
                                                Foto Yang Sama
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mt-4 mb-4">
                                        <label for="waktu" class="col-form-label">Bukti Transaksi :</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transaksi" id="exampleRadios4" onclick="tambah_transaksi()" value="ada">
                                            <label class="form-check-label" for="exampleRadios4">
                                                Ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="radio" name="transaksi" id="exampleRadios5" onclick="Hilang_transaksi()" value="gk">
                                            <label class="form-check-label" for="exampleRadios5">
                                                Tidak ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transaksi" id="exampleRadios6" onclick="old_transaksi()" value="old">
                                            <label class="form-check-label" for="exampleRadios6">
                                                Foto Yang Sama
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- upload bukti pembayaran -->
                                    <div class="file col-md-6 form-group">
                                        <label for="bukti" class="col-form-label">
                                            <h6>Bukti Pembayaran :</h6>
                                        </label>
                                        <input accept=".IMG,.JPG,.JPEG,.PNG," required autocomplete="off" type="File" class="form-control" name="bukti" id="bukti">
                                    </div>
                                    <!--  -->
                                    <!-- foto bukti pembayaran -->
                                    <div class="old_bukti col-md-6 form-group  d-none">
                                        <label for="waktu" class="col-form-label">
                                            <h6?>Foto Bukti Pembayaran :</h6>
                                        </label>
                                        <?php foreach ($fotobukti as $row) : ?>
                                            <div class="form-check">
                                                <input checked class="foto_bukti form-check-input" type="radio" name="old_bukti" id="<?= $row['bukti']; ?>" value="<?= $row['bukti']; ?>">
                                                <label class="form-check-label m-4" for="<?= $row['bukti']; ?>">
                                                    <img src="../bukti/<?= $row['bukti']; ?>" alt="<?= $row['bukti']; ?>" width="100" height="100">
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!--  -->
                                    <!-- upload file transaksi -->
                                    <div class="file_transaksi col-md-6 form-group d-none">
                                        <label for="bukti" class="col-form-label">
                                            <h6>Bukti Transaksi :</h6>
                                        </label>
                                        <input accept=".IMG,.JPG,.JPEG,.PNG," required autocomplete="off" type="File" class="form-control" name="bukti_transaksi" id="bukti_transaksi">
                                    </div>
                                    <!--  -->
                                    <!-- foto bukti transaksi -->
                                    <div class="old_transaksi col-md-6 form-group d-none">
                                        <label for="waktu" class="col-form-label">
                                            <h6>Foto Bukti Transaksi :</h6>
                                        </label>
                                        <?php foreach ($fototransaksi as $row) : ?>
                                            <div class="form-check">
                                                <input checked class="foto_lama form-check-input" type="radio" name="old_transaki" id="<?= $row['transaksi']; ?>" value="<?= $row['transaksi']; ?>">
                                                <label class="form-check-label m-4" for="<?= $row['transaksi']; ?>">
                                                    <a href="../bukti_transaksi/<?= $row['transaksi']; ?>" target="_blank" rel="noopener noreferrer"><img src="../bukti_transaksi/<?= $row['transaksi']; ?>" alt="" width="100" height="100"></a>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!--  -->
                                </div>
                            <?php } elseif ($userquery['bukti'] == NULL && $userquery['transaksi'] != NULL) { ?>
                                <div class="row">
                                    <div class="col-md-6 form-group mt-4 mb-4">
                                        <label for="waktu" class="col-form-label">Bukti Pembayaran? :</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode" id="exampleRadios1" onclick="tambah()" value="ada">
                                            <label class="form-check-label" for="exampleRadios1">
                                                Ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="radio" name="metode" id="exampleRadios2" onclick="Hilang()" value="gk">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Tidak ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode" id="exampleRadios3" onclick="old()" value="old">
                                            <label class="form-check-label" for="exampleRadios3">
                                                Foto Yang Sama
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mt-4 mb-4">
                                        <label for="waktu" class="col-form-label">Bukti Transaksi :</label>
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="radio" name="transaksi" id="exampleRadios4" onclick="tambah_transaksi()" value="ada">
                                            <label class="form-check-label" for="exampleRadios4">
                                                Ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transaksi" id="exampleRadios5" onclick="Hilang_transaksi()" value="gk">
                                            <label class="form-check-label" for="exampleRadios5">
                                                Tidak ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transaksi" id="exampleRadios6" onclick="old_transaksi()" value="old">
                                            <label class="form-check-label" for="exampleRadios6">
                                                Foto Yang Sama
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- upload bukti pembayaran -->
                                    <div class="file col-md-6 form-group d-none">
                                        <label for="bukti" class="col-form-label">
                                            <h6>Bukti Pembayaran :</h6>
                                        </label>
                                        <input accept=".IMG,.JPG,.JPEG,.PNG," required autocomplete="off" type="File" class="form-control" name="bukti" id="bukti">
                                    </div>
                                    <!--  -->
                                    <!-- foto bukti pembayaran -->
                                    <div class="old_bukti col-md-6 form-group  d-none">
                                        <label for="waktu" class="col-form-label">
                                            <h6?>Foto Bukti Pembayaran :</h6>
                                        </label>
                                        <?php foreach ($fotobukti as $row) : ?>
                                            <div class="form-check">
                                                <input checked class="foto_bukti form-check-input" type="radio" name="old_bukti" id="<?= $row['bukti']; ?>" value="<?= $row['bukti']; ?>">
                                                <label class="form-check-label m-4" for="<?= $row['bukti']; ?>">
                                                    <img src="../bukti/<?= $row['bukti']; ?>" alt="<?= $row['bukti']; ?>" width="100" height="100">
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!--  -->
                                    <!-- upload file transaksi -->
                                    <div class="file_transaksi col-md-6 form-group">
                                        <label for="bukti" class="col-form-label">
                                            <h6>Bukti Transaksi :</h6>
                                        </label>
                                        <input accept=".IMG,.JPG,.JPEG,.PNG," required autocomplete="off" type="File" class="form-control" name="bukti_transaksi" id="bukti_transaksi">
                                    </div>
                                    <!--  -->
                                    <!-- foto bukti transaksi -->
                                    <div class="old_transaksi col-md-6 form-group d-none">
                                        <label for="waktu" class="col-form-label">
                                            <h6>Foto Bukti Transaksi :</h6>
                                        </label>
                                        <?php foreach ($fototransaksi as $row) : ?>
                                            <div class="form-check">
                                                <input checked class="foto_lama form-check-input" type="radio" name="old_transaki" id="<?= $row['transaksi']; ?>" value="<?= $row['transaksi']; ?>">
                                                <label class="form-check-label m-4" for="<?= $row['transaksi']; ?>">
                                                    <a href="../bukti_transaksi/<?= $row['transaksi']; ?>" target="_blank" rel="noopener noreferrer"><img src="../bukti_transaksi/<?= $row['transaksi']; ?>" alt="" width="100" height="100"></a>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!--  -->
                                </div>
                            <?php } elseif ($userquery['bukti'] != NULL && $userquery['transaksi'] != NULL) { ?>
                                <div class="row">
                                    <div class="col-md-6 form-group mt-4 mb-4">
                                        <label for="waktu" class="col-form-label">Bukti Pembayaran? :</label>
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="radio" name="metode" id="exampleRadios1" onclick="tambah()" value="ada">
                                            <label class="form-check-label" for="exampleRadios1">
                                                Ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode" id="exampleRadios2" onclick="Hilang()" value="gk">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Tidak ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode" id="exampleRadios3" onclick="old()" value="old">
                                            <label class="form-check-label" for="exampleRadios3">
                                                Foto Yang Sama
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mt-4 mb-4">
                                        <label for="waktu" class="col-form-label">Bukti Transaksi :</label>
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="radio" name="transaksi" id="exampleRadios4" onclick="tambah_transaksi()" value="ada">
                                            <label class="form-check-label" for="exampleRadios4">
                                                Ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transaksi" id="exampleRadios5" onclick="Hilang_transaksi()" value="gk">
                                            <label class="form-check-label" for="exampleRadios5">
                                                Tidak ada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transaksi" id="exampleRadios6" onclick="old_transaksi()" value="old">
                                            <label class="form-check-label" for="exampleRadios6">
                                                Foto Yang Sama
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- upload bukti pembayaran -->
                                    <div class="file col-md-6 form-group">
                                        <label for="bukti" class="col-form-label">
                                            <h6>Bukti Pembayaran :</h6>
                                        </label>
                                        <input accept=".IMG,.JPG,.JPEG,.PNG," required autocomplete="off" type="File" class="form-control" name="bukti" id="bukti">
                                    </div>
                                    <!--  -->
                                    <!-- foto bukti pembayaran -->
                                    <div class="old_bukti col-md-6 form-group  d-none">
                                        <label for="waktu" class="col-form-label">
                                            <h6?>Foto Bukti Pembayaran :</h6>
                                        </label>
                                        <?php foreach ($fotobukti as $row) : ?>
                                            <div class="form-check">
                                                <input checked class="foto_bukti form-check-input" type="radio" name="old_bukti" id="<?= $row['bukti']; ?>" value="<?= $row['bukti']; ?>">
                                                <label class="form-check-label m-4" for="<?= $row['bukti']; ?>">
                                                    <img src="../bukti/<?= $row['bukti']; ?>" alt="<?= $row['bukti']; ?>" width="100" height="100">
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!--  -->
                                    <!-- upload file transaksi -->
                                    <div class="file_transaksi col-md-6 form-group">
                                        <label for="bukti" class="col-form-label">
                                            <h6>Bukti Transaksi :</h6>
                                        </label>
                                        <input accept=".IMG,.JPG,.JPEG,.PNG," required autocomplete="off" type="File" class="form-control" name="bukti_transaksi" id="bukti_transaksi">
                                    </div>
                                    <!--  -->
                                    <!-- foto bukti transaksi -->
                                    <div class="old_transaksi col-md-6 form-group d-none">
                                        <label for="waktu" class="col-form-label">
                                            <h6>Foto Bukti Transaksi :</h6>
                                        </label>
                                        <?php foreach ($fototransaksi as $row) : ?>
                                            <div class="form-check">
                                                <input checked class="foto_lama form-check-input" type="radio" name="old_transaki" id="<?= $row['transaksi']; ?>" value="<?= $row['transaksi']; ?>">
                                                <label class="form-check-label m-4" for="<?= $row['transaksi']; ?>">
                                                    <a href="../bukti_transaksi/<?= $row['transaksi']; ?>" target="_blank" rel="noopener noreferrer"><img src="../bukti_transaksi/<?= $row['transaksi']; ?>" alt="" width="100" height="100"></a>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!--  -->
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

        const file_transaksi = document.querySelector('.file_transaksi');
        const inputF_transaksi = document.getElementById('bukti_transaksi')

        const old_trnski = document.querySelector('.old_transaksi')
        const foto_lama = document.querySelector('.foto_lama')

        const foto_bukti = document.querySelector('.foto_bukti')
        const old_bukti = document.querySelector('.old_bukti')

        function Hilang() {
            file.classList.add('d-none');
            inputF.removeAttribute('required');
            old_bukti.classList.add('d-none');
            foto_bukti.removeAttribute('required');
        }

        function Hilang_transaksi() {
            file_transaksi.classList.add('d-none');
            old_trnski.classList.add('d-none');
            inputF_transaksi.removeAttribute('required');
            foto_lama.removeAttribute('required');
        }

        function old_transaksi() {
            file_transaksi.classList.add('d-none');
            inputF_transaksi.removeAttribute('required');
            old_trnski.classList.remove('d-none');
            foto_lama.setAttribute('required', '');
        }

        function old() {
            file.classList.add('d-none');
            inputF.removeAttribute('required');
            old_bukti.classList.remove('d-none');
            foto_bukti.setAttribute('required', '');
        }

        function tambah() {
            file.classList.remove('d-none');
            old_bukti.classList.add('d-none');
            inputF.setAttribute('required', '');
            foto_bukti.removeAttribute('required');
        }

        function tambah_transaksi() {
            file_transaksi.classList.remove('d-none');
            old_trnski.classList.add('d-none');
            inputF_transaksi.setAttribute('required', '');
            foto_lama.removeAttribute('required');
        }
    </script>
</body>

</html>