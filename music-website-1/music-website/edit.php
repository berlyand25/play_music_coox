<?php
    if (!isset($_POST['submit'])) {
        echo "<script>document.location.href='lihat_data.php';</script>";
    
        die();
    }

    session_start();

    include "koneksi.php";

    $id_user = $_SESSION['id_user'];

    $sql = "SELECT * FROM user WHERE id_user='$id_user'";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    $user = mysqli_fetch_assoc($query);

    $id_lagu = $_POST['id_lagu'];

    $sql = "SELECT * FROM lagu WHERE id_lagu='$id_lagu'";
    $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

    $data = mysqli_fetch_assoc($query);
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
                    <h4 class="active"><a href="edit.php"><span></span><i class="bi bi-music-note-beamed"></i>Edit Data</a></h4>
                <?php else : ?>
                    <h4 class="active"><a href="index.php"><span></span><i class="bi bi-music-note-beamed"></i>Home</a></h4>
                    <h4><a href="hubungi_kami.php"><span></span><i class="bi bi-music-note-beamed"></i>Hubungi Kami</a></h4>
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
                <h1>Edit Data</h1>
                <form action="proses_edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_lagu" value="<?= $data['id_lagu'] ?>">

                    <label for="judul_lagu">Judul Lagu : </label><br>
                    <input type="text" name="judul_lagu" id="judul_lagu" value="<?= $data['judul_lagu']?>" maxlength="30" required><br>

                    <label for="penyanyi">Penyanyi : </label><br>
                    <input type="text" name="penyanyi" id="penyanyi" value="<?= $data['penyanyi']?>" maxlength="40" required><br>

                    <label for="file_poster">Poster : </label><br>
                    <img width="100px" height="100px" src="<?= 'img/' . $data['file_poster'] ?>" alt=""><br>
                    <input type="file" name="file_poster" id="file_poster" accept=".jpg"><br>

                    <label for="file_lagu">Lagu : </label><br>
                    <audio style="margin-top: 5px;" controls>
                        <source src="<?= 'audio/' . $data['file_lagu'] ?>" type="audio/mpeg"></source>
                    </audio><br>
                    <input type="file" name="file_lagu" id="file_lagu" accept=".mp3"><br>

                    <label for="kategori">Kategori : </label><br>
                    <select name="kategori" id="kategori" required>
                        <option disabled selected hidden>Pilih Kategori</option>
                        <option value="premium" <?= ($data['kategori'] == 'premium') ? 'selected' : '' ?>>Premium</option>
                        <option value="non-premium" <?= ($data['kategori'] == 'non-premium') ? 'selected' : '' ?>>Non-Premium</option>
                    </select><br>

                    <button id="edit-data" type="submit" name="submit">Edit Data</button>
                    <button id="cancel" onclick="location.href='lihat_data.php';">Batal</button>
                </form>
            </div>
        </div>
        <div class="master-play">
        </div>
    </header>
</body>
</html>