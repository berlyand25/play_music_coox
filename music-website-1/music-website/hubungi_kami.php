<?php
    session_start();

    include "koneksi.php";

    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];

        $sql = "SELECT * FROM user WHERE id_user='$id_user'";
        $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

        $user = mysqli_fetch_assoc($query);

        if ($user['id_user'] == 1) {
            echo "<script>document.location.href='index.php';</script>";
        
            die();
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo-play-music-coox.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <title>Play Music COOX</title>
</head>
<body>
    <header>
        <div class="menu-side">
            <h1>COOX</h1>
            <div class="playlist">
                <?php if (isset($_SESSION['id_user']) && $id_user == 1) : ?>
                    <h4><a href="index.php"><span></span><i class="bi bi-music-note-beamed"></i>Home</a></h4>
                    <h4><a href="lihat_data.php"><span></span><i class="bi bi-music-note-beamed"></i>Lihat Data</a></h4>
                    <h4><a href="tambah_data.php"><span></span><i class="bi bi-music-note-beamed"></i>Tambah Data</a></h4>
                <?php else : ?>
                    <h4><a href="index.php"><span></span><i class="bi bi-music-note-beamed"></i>Home</a></h4>
                    <h4 class="active"><a href="hubungi_kami.php"><span></span><i class="bi bi-music-note-beamed"></i>Hubungi Kami</a></h4>
                <?php endif; ?>
            </div>
        </div>
        <div class="song-side">
            <nav>
                <div class="search">  
                </div>
                <div class="user">
                    <?php if (isset($_SESSION['id_user'])) : ?>
                        <div><?= $user['username'] ?></div>
                        <div><a href="logout.php">Logout</a></div>
                    <?php else : ?>
                        <div><a href="register.php">Register</a></div>
                        <div><a href="login.php">Login</a></div>
                    <?php endif; ?>
                </div>
            </nav>
            <div id="container" class="menu-song">
                <h1>Hubungi Kami</h1>
                <p class="h1-ket">Kirim feedback kamu untuk mendukung COOX.<br>Komentar dan saran kamu sangat dihargai!</p>
                <div class="hubungi-kami">
                    <h4><i class="bi bi-envelope"></i>Hubungi Kami</h4>
                    <hr>
                    <p class="email">berlyand0007@gmail.com</p>
                    <p class="ket">Silakan berikan feedback kamu untuk COOX.</p>
                    <p class="email">mafifbashair@gmail.com</p>
                    <p class="ket">Silakan berikan feedback kamu untuk COOX.</p>
                </div>
            </div>
        </div>
        <div class="master-play">
        </div>
    </header>
</body>
</html>