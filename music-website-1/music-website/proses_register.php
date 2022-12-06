<?php
    session_start();

    if (!isset($_POST['submit'])) {
        echo "<script>document.location.href='register.php';</script>";

        die();
    }

    include "koneksi.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    $sql = "SELECT username FROM user WHERE username = '$username'";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    if (mysqli_fetch_assoc($query)) {
        echo "<script>alert('Registrasi gagal! Username sudah terdaftar'); document.location.href='register.php';</script>";

        die();
    }

    if ($password !== $konfirmasi_password) {
        echo "<script>alert('Registrasi gagal! Konfirmasi password tidak sesuai'); document.location.href='register.php';</script>";

        die();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user VALUES('','$username','$password')";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    if ($query) {
        echo "<script>alert('Registrasi berhasil!'); document.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal!'); document.location.href='register.php';</script>";
    }
?>