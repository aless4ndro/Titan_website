<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="./assets/player.css">


<?php
// Votre connexion à la base de données
include('config.php');

if (isset($_GET['id'])) { // Si aucun ID n'est passé dans l'URL, rediriger vers la page principale
    $album_id = $_GET['id']; // Récupérer l'ID de l'album dans l'URL

    $stmt = $conn->prepare("SELECT * FROM albums WHERE id = ?");// Récupérer l'album
    $stmt->execute([$album_id]);// On utilise la méthode execute() pour exécuter notre requête
    $album = $stmt->fetch(PDO::FETCH_ASSOC);// On utilise la méthode fetch() pour récupérer les données de la requête

    $stmt = $conn->prepare("SELECT * FROM audio WHERE album_id = ?"); // Récupérer les audios de l'album
    $stmt->execute([$album_id]);
    $audios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $titles = array();
    foreach ($audios as $audio) {
        $titles[] = $audio['title'];
    }

    if ($album) {
        echo '<section>';
        echo '<div class="audio">';
        echo '<div class="progress"></div>';

        echo '<div class="info">';
        echo '<div class="thumbnail">';
        echo '<img src="http://localhost:8001/' . $album['cover_image_path'] . '" alt="Album cover">';
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

        $stmt2 = $conn->prepare("SELECT * FROM audio WHERE album_id = ?");
        $stmt2->execute([$album_id]);
        $tracks = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tracks as $track) {
            echo '<audio hidden src="http://localhost:8001/' . $track['file_path'] . '"></audio>';
        }
    }

    echo '<script>';
    echo 'var titles = ' . json_encode($titles) . ';';
    echo '</script>';
}
?>
<script src="./assets/player.js"></script>