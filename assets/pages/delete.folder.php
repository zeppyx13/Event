<?php
require '../config/php/backend.php';
session_start();
error_reporting(0);
$email = $_SESSION['email'];
$user = query("SELECT * FROM user WHERE Email = '$email'")[0];
$id_user = $user['id'];
$akses = query("SELECT * FROM akses WHERE id_user = '$id_user'")[0];
$id_user = $user['id'];
$id = $_GET['id_folder'];
$query = "DELETE FROM folder WHERE id= '$id'";
mysqli_query($konek, $query);
if ($query) {
    if ($akses['Gallery'] == 'TRUE') {
        echo "<script>
        alert('Delete folder Berhasil');
        document.location.href='../../dashboard/gallery.php';
        </script>
        ";
        exit;
    } else {
        echo "<script>
        alert('Delete folder Berhasil');
        document.location.href='../../admin/gallery.php';
        </script>
        ";
        exit;
    }
} else {
    if ($akses['Gallery'] == 'TRUE') {
        echo "<script>
        alert('Delete folder Gagal');
        document.location.href='../../dashboard/gallery.php';
        </script>
        ";
        exit;
    } else {
        echo "<script>
        alert('Delete folder Gagal');
        document.location.href='../../admin/gallery.php';
        </script>
        ";
        exit;
    }
}
