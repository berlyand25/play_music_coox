<?php
    session_start();

    include "koneksi.php";

    $data = [];

    if (isset($_SESSION['id_user'])) {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];

            $sql = "SELECT * FROM lagu LIMIT 1";
            $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }

            $idLagu0 = $data[0]['id_lagu'];

            $sql = "SELECT * FROM lagu WHERE 
            (judul_lagu LIKE '%$keyword%' or 
            penyanyi LIKE '%$keyword%' or 
            kategori LIKE '%$keyword%')";
            $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

            $banyakLaguTampil = mysqli_num_rows($query);

            $sql = "SELECT * FROM lagu WHERE 
            (judul_lagu LIKE '%$keyword%' or 
            penyanyi LIKE '%$keyword%' or 
            kategori LIKE '%$keyword%') and id_lagu!='$idLagu0'";
            $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        } else {
            $sql =  "SELECT * FROM lagu";
            $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

            $banyakLaguTampil = mysqli_num_rows($query);

            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }

        $id_user = $_SESSION['id_user'];

        $sql = "SELECT * FROM user WHERE id_user='$id_user'";
        $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

        $user = mysqli_fetch_assoc($query);
    } else {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];

            $sql = "SELECT * FROM lagu LIMIT 1";
            $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }

            $idLagu0 = $data[0]['id_lagu'];

            $sql = "SELECT * FROM lagu WHERE 
            (judul_lagu LIKE '%$keyword%' or 
            penyanyi LIKE '%$keyword%') and
            kategori='non-premium'";
            $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

            $banyakLaguTampil = mysqli_num_rows($query);

            $sql = "SELECT * FROM lagu WHERE 
            (judul_lagu LIKE '%$keyword%' or 
            penyanyi LIKE '%$keyword%') and
            kategori='non-premium' and id_lagu!='$idLagu0'";
            $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        } else {
            $sql =  "SELECT * FROM lagu WHERE kategori='non-premium'";
            $query = mysqli_query($konek,$sql) or die(mysqli_error($konek));

            $banyakLaguTampil = mysqli_num_rows($query);

            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
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
                    <h4 class="active"><a href="index.php"><span></span><i class="bi bi-music-note-beamed"></i>Home</a></h4>
                    <h4><a href="lihat_data.php"><span></span><i class="bi bi-music-note-beamed"></i>Lihat Data</a></h4>
                    <h4><a href="tambah_data.php"><span></span><i class="bi bi-music-note-beamed"></i>Tambah Data</a></h4>
                <?php else : ?>
                    <h4 class="active"><a href="index.php"><span></span><i class="bi bi-music-note-beamed"></i>Home</a></h4>
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
                <h1>COOX Playlist</h1>
                <?php if (!isset($_SESSION['id_user'])) : ?>
                    <p style="padding: 5px 0px 5px 20px; color: #4c5262;">Untuk bisa menikmati lagu yang lebih banyak, silahkan login terlebih dahulu.</p>
                <?php endif; ?>
                <?php $i = 1; ?>
                <?php foreach($data as $song) : ?>
                    <?php if ($banyakLaguTampil == count($data)) : ?>
                        <li class="song-item" id="<?= $song['id_lagu']?>" name="<?= $i ?>">
                            <span><?= $i++ ?></span>
                            <img src="img/<?= $song['file_poster'] ?>" alt="<?= $song['judul_lagu'] ?>">
                            <h5>
                                <?= $song['judul_lagu'] ?>
                                <div class="subtitle"><?= $song['penyanyi'] ?></div>
                            </h5>
                        </li>
                    <?php else : ?>
                        <?php if ($i != 1) : ?>
                            <li class="song-item" id="<?= $song['id_lagu']?>" name="<?= $i-1 ?>">
                                <span><?= $i-1 ?></span>
                                <img src="img/<?= $song['file_poster'] ?>" alt="<?= $song['judul_lagu'] ?>">
                                <h5>
                                    <?= $song['judul_lagu'] ?>
                                    <div class="subtitle"><?= $song['penyanyi'] ?></div>
                                </h5>
                            </li>
                        <?php endif; ?>
                        <?php $i++; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="master-play">
            <div class="wave">
                <div class="wave1"></div>
                <div class="wave1"></div>
                <div class="wave1"></div>
            </div>
            <img src="img/<?= $data[0]['file_poster'] ?>" alt="" id="poster-master-play">
            <h5 id="title">
                <?= $data[0]['judul_lagu'] ?> <br>
                <div class="subtitle"><?= $data[0]['penyanyi'] ?></div>
            </h5>
            <div class="icon">
                <i class="bi bi-skip-start-fill" id="back"></i>
                <i class="bi bi-play-fill" id="master-play"></i>
                <i class="bi bi-skip-end-fill" id="next"></i>
            </div>
            <span id="current-start">0:00</span>
            <div class="bar">
                <input type="range" id="seek" min="0" value="0" max="100">
                <div class="bar2" id="bar2"></div>
                <div class="dot" id="dot"></div>
            </div>
            <span id="current-end">0:00</span>
            <div class="vol">
                <i class="bi bi-volume-down-fill" id="vol-icon"></i>
                <input type="range" id="vol" min="0" value="30" max="100">  
                <div class="vol-bar"></div>
                <div class="dot" id="vol-dot"></div>
            </div>
        </div>
    </header>
    <script >
        let music = new Audio('audio/<?= $data[0]['id_lagu'] ?>.mp3');

        let songs = []; 

        <?php foreach ($data as $song) : ?>
            songs.push({
                id_lagu: <?= $song['id_lagu'] ?>,
                judul_dan_penyanyi: `<?= $song['judul_lagu'] ?> <br> <div class="subtitle"><?= $song['penyanyi'] ?></div>`,
                file_poster: "<?= $song['file_poster'] ?>"
            });
        <?php endforeach; ?>

        let index = 1;
        let ind;
        let masterPlay = document.getElementById('master-play');
        let wave = document.getElementsByClassName('wave')[0];

        masterPlay.addEventListener('click',()=> {
            if (music.paused || music.currentTime <= 0) {
                music.play();
                masterPlay.classList.replace('bi-play-fill','bi-pause-fill');
                wave.classList.add('active2');

            } else {
                music.pause();
                masterPlay.classList.replace('bi-pause-fill','bi-play-fill');
                wave.classList.remove('active2');
            }
        });

        const makeAllBackgrounds = () => {
            Array.from(document.getElementsByClassName('song-item')).forEach((element)=> {
                element.style.background = "rgb(105,105,170,0)";
            });  
        };

        <?php if ($banyakLaguTampil == count($data)) : ?>
            makeAllBackgrounds();
            Array.from(document.getElementsByClassName('song-item'))[0].style.background = "rgb(105,105,170,.1)";
        <?php endif; ?>

        let poster_master_play = document.getElementById('poster-master-play');
        let title = document.getElementById('title');

        Array.from(document.getElementsByClassName('song-item')).forEach((element)=> {
            element.addEventListener('click',()=> {
                index = element.getAttribute('name');
                ind = element.id;

                music.src = `audio/${ind}.mp3`;
                poster_master_play.src = `img/${ind}.jpg`;
                music.play();

                let song_title = songs.filter((ele) => {
                    return ele.id_lagu == ind;
                });

                song_title.forEach(ele => {
                    let {judul_dan_penyanyi} = ele;
                    title.innerHTML = judul_dan_penyanyi;
                });

                masterPlay.classList.replace('bi-play-fill','bi-pause-fill');
                wave.classList.add('active2');

                music.addEventListener('ended',()=> {
                    masterPlay.classList.replace('bi-pause-fill','bi-play-fill');
                    wave.classList.remove('active2');
                });

                makeAllBackgrounds();
                element.style.background = "rgb(105,105,170,.1)";
            });
        });   

        let currentStart = document.getElementById('current-start');
        let currentEnd = document.getElementById('current-end');
        let seek = document.getElementById('seek');
        let bar2 = document.getElementById('bar2');
        let dot = document.getElementsByClassName('dot');
        let menit1, detik1, menit2, detik2;

        music.addEventListener('timeupdate',()=> {
            menit1 = Math.floor(music.duration/60);
            detik1 = Math.floor(music.duration%60);

            if (detik1 < 10) {
                if (menit1 === menit1 && detik1 === detik1) {
                    currentEnd.innerText = `${menit1}:0${detik1}`;
                }
            } else {
                if (menit1 === menit1 && detik1 === detik1) {
                    currentEnd.innerText = `${menit1}:${detik1}`;
                }
            }

            menit2 = Math.floor(music.currentTime/60);
            detik2 = Math.floor(music.currentTime%60);

            if (detik2 < 10) {
                if (menit2 === menit2 && detik2 === detik2) {
                    currentStart.innerText = `${menit2}:0${detik2}`;
                }
            } else {
                if (menit2 === menit2 && detik2 === detik2) {
                    currentStart.innerText = `${menit2}:${detik2}`;
                }
            }

            let progressBar = parseInt((music.currentTime/music.duration)*100);
            bar2.style.width = `${progressBar}%`;
            dot[0].style.left = `${progressBar}%`;
        });

        seek.addEventListener('change',()=> {
            music.currentTime = seek.value*music.duration/100;
        });

        music.addEventListener('ended',()=> {
            masterPlay.classList.replace('bi-pause-fill','bi-play-fill');
            wave.classList.remove('active2');
        });

        let vol_icon = document.getElementById('vol-icon');
        let vol = document.getElementById('vol');
        let vol_dot = document.getElementById('vol-dot');
        let vol_bar = document.getElementsByClassName('vol-bar')[0];

        vol.addEventListener('change',()=> {
            if (vol.value == 0) {
                vol_icon.classList.remove('bi-volume-down-fill');
                vol_icon.classList.remove('bi-volume-up-fill');
                vol_icon.classList.add('bi-volume-mute-fill');
            } else if (0 < vol.value && vol.value < 50) {
                vol_icon.classList.remove('bi-volume-mute-fill');
                vol_icon.classList.remove('bi-volume-up-fill');
                vol_icon.classList.add('bi-volume-down-fill');
            } else if (50 <= vol.value && vol.value <= 100) {
                vol_icon.classList.remove('bi-volume-mute-fill');
                vol_icon.classList.remove('bi-volume-down-fill');
                vol_icon.classList.add('bi-volume-up-fill');
            }

            music.volume = vol.value/100;
            vol_bar.style.width = `${vol.value}%`;
            vol_dot.style.left = `${vol.value}%`;
        });

        let back = document.getElementById('back');
        let next = document.getElementById('next');
        let count = document.getElementsByTagName('li').length;

        back.addEventListener('click',()=>{
            if (index == 1) {
                index = count;
            } else {
                index--;
            }

            ind = Array.from(document.getElementsByClassName('song-item'))[`${index-1}`].id;

            music.src = `audio/${ind}.mp3`;
            poster_master_play.src = `img/${ind}.jpg`;
            music.play();
            
            masterPlay.classList.replace('bi-play-fill','bi-pause-fill');
            wave.classList.add('active2');

            let song_title = songs.filter((ele) => {
                return ele.id_lagu == ind;
            });

            song_title.forEach(ele => {
                let {judul_dan_penyanyi} = ele;
                title.innerHTML = judul_dan_penyanyi;
            });

            makeAllBackgrounds();
            Array.from(document.getElementsByClassName('song-item'))[`${index-1}`].style.background = "rgb(105,105,170,.1)";
        });

        next.addEventListener('click',()=>{
            if (index == count) {
                index = 1;
            } else {
                index++;
            }

            ind = Array.from(document.getElementsByClassName('song-item'))[`${index-1}`].id;

            music.src = `audio/${ind}.mp3`;
            poster_master_play.src = `img/${ind}.jpg`;
            music.play();
            
            masterPlay.classList.replace('bi-play-fill','bi-pause-fill');
            wave.classList.add('active2');

            let song_title = songs.filter((ele) => {
                return ele.id_lagu == ind;
            });

            song_title.forEach(ele => {
                let {judul_dan_penyanyi} = ele;
                title.innerHTML = judul_dan_penyanyi;
            });


            makeAllBackgrounds();
            Array.from(document.getElementsByClassName('song-item'))[`${index-1}`].style.background = "rgb(105,105,170,.1)";
        });
    </script>
</body>
</html>