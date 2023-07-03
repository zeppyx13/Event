<?php
require '../config/php/backend.php';
$id = $_GET['id'];
$query = "DELETE FROM deadline WHERE id= '$id'";
mysqli_query($konek, $query);
if ($query) {
    echo "<script>
    alert('Delete season Berhasil');
    document.location.href='./detail.season.php';
    </script>
    ";
    exit;
} else {
    echo "<script>
    alert('Delete season Gagal');
    document.location.href='./detail.season.php';
    </script>
    ";
    exit;
}
