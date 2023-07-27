<?php
include('config.php');
include('./include/header.php');
?>
<link rel="stylesheet" href="./assets/album_details.css">
<?php


if (!isset($_GET['id'])) {
    // Si aucun ID n'est passé dans l'URL, rediriger vers la page principale
    header('Location: index.php');
    exit;
}

$album_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM albums WHERE id = ?");
$stmt->execute([$album_id]);
$album = $stmt->fetch(PDO::FETCH_ASSOC);

if ($album) {
    echo '<div class="container">';

    echo '<div class= "title">';
    echo '<h1>' . $album['title'] . '</h1>';
    echo '</div>';

    echo '<div class="row">'; // Row container for the image and the tracks

    // Album card with image
    echo '<div class="col-md-6">';
    echo '<div class="card" >';
    echo '<div class="view overlay">';
    echo '<img class="card-img-top" src="http://localhost:8001/' . $album['cover_image_path'] . '" alt="Album cover">';
    echo '<a href="#!"><div class="mask rgba-white-slight"></div></a>';
    echo '</div>'; // End of the view
    echo '</div>'; // End of the card
    echo '</div>'; // End of the column

    // Tracks
    echo '<div class="col-md-6">'; // Column for the tracks
    echo '<h3>TITAN BEARD</h3>';
    echo '<h3>' . $album['title'] . '</h3>';
    echo '<br>';

    $stmt2 = $conn->prepare("SELECT * FROM audio WHERE album_id = ?");
    $stmt2->execute([$album_id]);
    $tracks = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    $num_tracks = count($tracks);

    echo '<p class="p">(' . $num_tracks . ') TITRES</p>'; // Afficher le nombre de pistes à côté de "TITRES"

    $count = 1; // Initialiser la variable de compteur
    foreach ($tracks as $track) {
        echo '<div class="tilte_audio">' . $count . '. ' . $track['title'] . '</div>';
        $count++; // Incrémenter le compteur à chaque itération
    }

    include('player.php');
    echo '<div class="music-icon"><i class=\'bx bxs-music\'></i></div>';
    
    echo '</div>'; // End of the column

    echo '</div>'; // End of the row

    echo '</div>'; // End of the container

} else {
    echo 'Album non trouvé';
}

?>


<?php include('./include/footer.php'); ?>

<!--Dans ce code, nous utilisons une deuxième instance de PDOStatement ($stmt2) pour exécuter la deuxième requête, ce qui nous permet de récupérer les détails de l'album avant de récupérer les pistes audio. Nous utilisons ensuite une boucle foreach pour parcourir chaque piste audio et afficher un lecteur audio pour chaque piste.-->