<?php
require '../config/php/backend.php';
$id = $_GET['id'];
$query = "DELETE FROM user WHERE id= '$id'";
mysqli_query($konek, $query);
if ($query) {
    echo "<script>
    alert('Delete user Berhasil');
    document.location.href='./detail.profile.php';
    </script>
    ";
    exit;
} else {
    echo "<script>
    alert('Delete user Gagal');
    document.location.href='./detail.profile.php';
    </script>
    ";
    exit;
}
