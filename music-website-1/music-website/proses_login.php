<?php
    session_start();

    if (!isset($_POST['submit'])) {
        echo "<script>document.location.href='login.php';</script>";

        die();
    }

    include "koneksi.php";
    
    $username = $_POST['username'];
    $password = mysqli_escape_string($konek,$_POST['password']);

    $sql = "SELECT * FROM user WHERE username='$username'";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    $num_rows = mysqli_num_rows($query);

    if ($num_rows > 0) {
        $data = mysqli_fetch_assoc($query);

        if (password_verify($password,$data['password'])) {
            $_SESSION['id_user'] = $data['id_user'];

            echo "<script>document.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Login gagal! Username atau Password salah'); document.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Login gagal! Username atau Password salah'); document.location.href='login.php';</script>";
    }
?>