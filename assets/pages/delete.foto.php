<?php
require '../config/php/backend.php';
$id_folder = $_GET['id_folder'];
$id = $_GET['id_foto'];
$query = "DELETE FROM foto WHERE id_foto= '$id'";
mysqli_query($konek, $query);
if ($query) {
    echo "<script>
    alert('Delete folfoto Berhasil');
    document.location.href='./detail.foto.php?id_folder=$id_folder';
    </script>
    ";
    exit;
} else {
    echo "<script>
    alert('Delete folfoto Gagal');
    document.location.href='./detail.foto.php?id_folder=$id_folder';
    </script>
    ";
    exit;
}
