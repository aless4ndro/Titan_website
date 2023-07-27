<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="./assets/player.css">


<?php
// Votre connexion à la base de données
include('config.php');



$stmt = $conn->prepare("SELECT * FROM audio WHERE lecteur = 1 ORDER BY position");
$stmt->execute();
$audios = $stmt->fetchAll(PDO::FETCH_ASSOC);

//On met les titres dans un tableau pour les utiliser dans le script JS
$titles = array();
foreach ($audios as $audio) {
    $titles[] = $audio['title'];
}

echo '<section>';
echo '<div class="audio">';
echo '<div class="progress"></div>';
echo '<div class="info">';
echo '<div class="thumbnail">';
echo '<img src="./img/BEARD T - RECTO CD Kiffé - 08 2016.jpg " alt="Album cover">'; // Image du lecteur global
echo '<span class="play_pause">';
echo '<i class="bx bx-play-circle"></i>';
echo '</span>';
echo '</div>';
echo '<div class="volume">';
echo '<span class="volume-down"> - </span>';
echo '<div class="volume-progress">';
echo '<div class="volume-bar"></div>';
echo '</div>';
echo '<span class="volume-up"> + </span>';
echo '</div>';
echo '<div class="action">';
echo '<div class="song">';
echo '<div class="song-title"></div>';
echo '</div>';
echo '<div class="time">';
echo '<span class="current">0:00</span> / <span class="duration">0:00</span>';
echo '<button> <i id="prev" class="bx bx-caret-left"></i> </button>';
echo '<button><i id="next" class="bx bx-caret-right"></i></button>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</section>';

foreach ($audios as $audio) {
    echo '<audio hidden src="http://localhost:8001/' . $audio['file_path'] . '"></audio>';
}
echo '<script>';
echo 'var titles = ' . json_encode($titles) . ';';
echo '</script>';

?>
<script src="./assets/player.js"></script>