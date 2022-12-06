<?php
    if (!isset($_POST['submit'])) {
        echo "<script>document.location.href='lihat_data.php';</script>";

        die();
    } 

    include "koneksi.php";
    
    $id_lagu = $_POST['id_lagu'];

    $namaFilePoster = $id_lagu . ".jpg";
    $namaFileLagu = $id_lagu . ".mp3";

    unlink("img/".$namaFilePoster);
    unlink("audio/".$namaFileLagu);

    $sql = "DELETE FROM lagu WHERE id_lagu='$id_lagu'";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    echo "<script>alert('Delete Data berhasil!'); document.location.href='lihat_data.php';</script>";
?>