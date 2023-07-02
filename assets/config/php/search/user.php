<?php
error_reporting(0);
require '../backend.php';
$keyword = $_GET['keyword'];
$iduser = $_GET['iduser'];
if ($keyword != "") {
    $query = "SELECT * FROM hutang INNER JOIN lokasi ON lokasi.Id_lokasi  = hutang.Id_tempat 
    WHERE hutang LIKE '%$keyword%' 
    OR keterangan LIKE '%$keyword%' 
    OR tanggal LIKE '%$keyword%' 
    OR Lokasi LIKE '%$keyword%' 
    AND Id_user = '$iduser'";
} else {
    $query = "SELECT * FROM hutang INNER JOIN lokasi ON lokasi.Id_lokasi  = hutang.Id_tempat WHERE Id_user = '$iduser'";
}
$cari = query($query);
?>
<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-center text-black font-weight-bolder">No</th>
            <th class="text-center text-uppercase text-black font-weight-bolder">Kewajiban</th>
            <th class="text-center text-uppercase text-black font-weight-bolder">Pembayaran</th>
            <th class="text-center text-uppercase text-black font-weight-bolder">Tempat</th>
            <th class="text-center text-uppercase text-black font-weight-bolder">Tanggal</th>
            <th class="text-center text-uppercase text-black font-weight-bolder">Keterangan</th>
            <th class="text-center text-uppercase text-black font-weight-bolder">Bukti</th>
            <th class="text-center text-uppercase text-black font-weight-bolder">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($cari as $row) : ?>
            <?php
            $fhutang = number_format($row['hutang'], 0, ',', '.');
            $fbayar = number_format($row['bayar'], 0, ',', '.');
            ?>
            <tr>
                <td class="text-center text-black"><?= $i ?></td>
                <td class="text-center text-black">Rp . <?= $fhutang ?></td>
                <td class="text-center text-black">Rp. <?= $fbayar ?></td>
                <td class="text-center text-black"><?= $row['Lokasi'] ?></td>
                <td class="text-center text-black"><?= $row['tanggal'] ?></td>
                <td class="text-center text-black"><?= $row['keterangan'] ?></td>
                <?php if ($row['bukti'] != NULL) { ?>
                    <td class="text-center text-black">
                        <a target="_blank" href="../bukti/<?= $row['bukti'] ?>">Bukti</a>
                    </td>
                <?php } else { ?>
                    <td class="text-center text-black">-</td>
                <?php } ?>
                <td class="text-center text-black">
                    <a href="./edit.user.php?id=<?= $row['Id_hutang'] ?>"><i class=" material-icons opacity-100">edit</i></a>
                    <a onclick="return confirm('Yakin ingin menghapus hutang?')" href="./delete.user.php?id=<?= $row['Id_hutang'] ?>&user=<?= $id ?>"><i class=" material-icons opacity-100">delete</i></a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
        <!-- decoy -->
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <!-- decoy -->
        <?php foreach ($cari as $row) : ?>
            <?php
            // var_dump($row);
            $hutang += $row['hutang'];
            $bayar += $row['bayar'];
            $sisahutang = $hutang - $bayar;
            $ffhutang = number_format($hutang, 0, ',', '.');
            $ffbayar = number_format($bayar, 0, ',', '.');
            $ffsisahutang = number_format($sisahutang, 0, ',', '.');
            ?>
        <?php endforeach; ?>
        <tr>
            <td class="text-end text-uppercase text-black font-weight-bolder p-2" colspan="7">Total Kewajiban :<strong>Rp. <?= $ffhutang ?></strong></td>
        </tr>
        <tr>
            <td class="text-end text-uppercase text-black font-weight-bolder p-2" colspan="7">Total Pembayaran : <strong>Rp. <?= $ffbayar ?></strong></td>
        </tr>
        <tr>
            <td class="text-end text-uppercase text-black font-weight-bolder p-2" colspan="7">Total Sisa Kewajiban :<strong>Rp. <?= $ffsisahutang ?></strong></td>
        </tr>
    </tbody>
</table>