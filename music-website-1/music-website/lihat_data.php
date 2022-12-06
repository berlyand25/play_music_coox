<?php
    session_start();

    if (!isset($_SESSION['id_user'])) {
        echo "<script>document.location.href='index.php';</script>";

        die();
    }

    include "koneksi.php";

    $data = [];

    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];

        $sql = "SELECT * FROM lagu WHERE 
        (judul_lagu LIKE '%$keyword%' or 
        penyanyi LIKE '%$keyword%' or 
        kategori LIKE '%$keyword%')";
        $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    } else {
        $sql =  "SELECT * FROM lagu";
        $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    $id_user = $_SESSION['id_user'];

    $sql = "SELECT * FROM user WHERE id_user='$id_user'";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    $user = mysqli_fetch_assoc($query);

    if ($user['id_user'] != 1) {
        echo "<script>document.location.href='index.php';</script>";
            
        die();
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
                    <h4 class="active"><a href="lihat_data.php"><span></span><i class="bi bi-music-note-beamed"></i>Lihat Data</a></h4>
                    <h4><a href="tambah_data.php"><span></span><i class="bi bi-music-note-beamed"></i>Tambah Data</a></h4>
                <?php else : ?>
                    <h4><a href="index.php"><span></span><i class="bi bi-music-note-beamed"></i>Home</a></h4>
                    <h4><a href="hubungi_kami.php"><span></span><i class="bi bi-music-note-beamed"></i>Hubungi Kami</a></h4>
                <?php endif; ?>
            </div>
        </div>
        <div class="song-side">
            <nav>
                <div class="search">
                    <form action="" method="get">
                        <input type="text" name="keyword" id="keyword" autocomplete="off" placeholder="Cari Lagu, Penyanyi">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
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
                <h1>Lihat Data</h1>
                <table border="1">
                    <tr>
                        <th>No</th>
                        <th>Judul Lagu</th>
                        <th>Penyanyi</th>
                        <th>Poster</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach($data as $song) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $song['judul_lagu'] ?></td>
                            <td><?= $song['penyanyi'] ?></td>
                            <td><img width="40px" heigth="40px" src="img/<?= $song['file_poster'] ?>"></td>
                            <td><?= $song['kategori'] ?></td>
                            <td>
                                <form action="edit.php" method="post">
                                    <input type="hidden" name="id_lagu" value="<?= $song['id_lagu']?>">
                                    <button type="submit" name="submit" id="edit">Edit</button>
                                </form>
                                <form onclick="confirm('Are you sure?')" action="proses_delete.php" method="post">
                                    <input type="hidden" name="id_lagu" value="<?= $song['id_lagu']?>">
                                    <button type="submit" name="submit" id="delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <div class="master-play">
        </div>
    </header>
</body>
</html>