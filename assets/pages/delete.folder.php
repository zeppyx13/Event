<?php
require '../config/php/backend.php';
$id = $_GET['id_folder'];
$query = "DELETE FROM folder WHERE id= '$id'";
mysqli_query($konek, $query);
if ($query) {
    echo "<script>
    alert('Delete folder Berhasil');
    document.location.href='../../admin/gallery.php';
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
