<?php
require '../config/php/backend.php';
$id = $_GET['id'];
$user = $_GET['user'];
$query = "DELETE FROM hutang WHERE Id_hutang = '$id'";
mysqli_query($konek, $query);
if ($query) {
    echo "<script>
    alert('Delete Hutang Berhasil');
    document.location.href='./detail.user.php?id=$user';
    </script>
    ";
    exit;
} else {
    echo "<script>
    alert('Delete Hutang Gagal');
    document.location.href='./detail.user.php?id=$user';
    </script>
    ";
    exit;
}
