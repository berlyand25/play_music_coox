<?php 
    if (!isset($_POST['submit'])) {
        echo "<script>document.location.href='lihat_data.php';</script>";

        die();
    } 

    include "koneksi.php";

    $id_lagu = $_POST['id_lagu'];

    $judul_lagu = htmlspecialchars($_POST['judul_lagu']);
    $penyanyi = htmlspecialchars($_POST['penyanyi']);
    $kategori = $_POST['kategori'];

    $judul_lagu = ucwords($judul_lagu);
    $penyanyi = ucwords($penyanyi);

    $sql = "UPDATE lagu SET judul_lagu='$judul_lagu', penyanyi='$penyanyi', kategori='$kategori' WHERE id_lagu='$id_lagu'";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    if ($_FILES['file_poster']['error'] === 0) {
        $tmpNamePoster = $_FILES['file_poster']['tmp_name'];
        $ukuranFilePoster = $_FILES['file_poster']['size'];

        if ($ukuranFilePoster > 500000) {
            echo "<script>alert('Ukuran poster terlalu besar! MAX = 500KB'); document.location.href='lihat_data.php';</script>";
            die();
        }

        $namaFilePoster = $id_lagu . ".jpg";

        unlink('img/'.$namaFilePoster);

        move_uploaded_file($tmpNamePoster,'img/' . $namaFilePoster);
    }

    if ($_FILES['file_lagu']['error'] === 0) {
        $tmpNameLagu = $_FILES['file_lagu']['tmp_name'];
        $ukuranFileLagu = $_FILES['file_lagu']['size'];

        if ($ukuranFileLagu > 7000000) {
            echo "<script>alert('Ukuran lagu terlalu besar! MAX = 7MB'); document.location.href='lihat_data.php';</script>";
            die();
        }

        $namaFilelagu = $id_lagu . ".mp3";

        unlink('audio/'.$namaFilelagu);

        move_uploaded_file($tmpNamelagu,'audio/' . $namaFilelagu);
    }

    echo "<script>alert('Edit Data berhasil!'); document.location.href='lihat_data.php';</script>";
?>