<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "play_music_coox";

    $konek = new mysqli($hostname,$username,$password,$database);

    if ($konek->connect_error) {
        die('Maaf koneksi gagal! : ' . $konek->connect_error);
    }
?>