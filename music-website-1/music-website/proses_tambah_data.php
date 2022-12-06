<?php 
    include "koneksi.php";

    if (!isset($_POST['submit'])) {
        echo "<script>document.location.href='tambah_data.php';</script>";
            
        die();
    }

    $judul_lagu = htmlspecialchars($_POST['judul_lagu']);
    $penyanyi = htmlspecialchars($_POST['penyanyi']);
    $kategori = $_POST['kategori'];

    $judul_lagu = ucwords($judul_lagu);
    $penyanyi = ucwords($penyanyi);

    $tmpNamePoster = $_FILES['file_poster']['tmp_name'];
    $ukuranFilePoster = $_FILES['file_poster']['size'];

    $tmpNameLagu = $_FILES['file_lagu']['tmp_name'];
    $ukuranFileLagu = $_FILES['file_lagu']['size'];

    if ($ukuranFilePoster > 500000) {
        echo "<script>alert('Ukuran poster terlalu besar! MAX = 500KB'); document.location.href='tambah_data.php';</script>";
        die();
    }

    if ($ukuranFileLagu > 7000000) {
        echo "<script>alert('Ukuran lagu terlalu besar! MAX = 7MB'); document.location.href='tambah_data.php';</script>";
        die();
    }

    $sql = "INSERT INTO lagu VALUES('','$judul_lagu','$penyanyi','','','$kategori')";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    $sql = "SELECT * FROM lagu WHERE judul_lagu='$judul_lagu' and penyanyi='$penyanyi' and file_poster='' and file_lagu='' and kategori='$kategori'";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    $data = mysqli_fetch_assoc($query);

    $id = $data['id_lagu'];
    $namaFilePoster = $id . ".jpg";
    $namaFileLagu = $id . ".mp3";

    move_uploaded_file($tmpNamePoster,'img/' . $namaFilePoster);
    move_uploaded_file($tmpNameLagu,'audio/' . $namaFileLagu);

    $sql = "UPDATE lagu SET file_poster='$namaFilePoster', file_lagu='$namaFileLagu' WHERE id_lagu='$id'";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    echo "<script>alert('Tambah Data berhasil!'); document.location.href='lihat_data.php';</script>";
?>