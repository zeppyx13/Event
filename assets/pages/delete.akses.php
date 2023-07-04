<?php
require '../config/php/backend.php';
$id = $_GET['id'];
$query = "DELETE FROM akses WHERE id_akses = '$id'";
mysqli_query($konek, $query);
if ($query) {
    echo "<script>
    alert('Delete akses Berhasil');
    document.location.href='./detail.akses.php';
    </script>
    ";
    exit;
} else {
    echo "<script>
    alert('Delete akses Gagal');
    document.location.href='./detail.akses.php';
    </script>
    ";
    exit;
}
