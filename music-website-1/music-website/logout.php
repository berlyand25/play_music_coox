<?php
    session_start();

    if (!isset($_SESSION['id_user'])) {
        echo "<script>alert('Anda belum login!'); document.location.href='index.php';</script>";

        die();
    }

    session_destroy();
    echo "<script>alert('Anda telah logout!'); document.location.href='index.php';</script>";
?>