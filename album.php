<?php


include('./include/header.php');
include('config.php');

?>

  <link rel="stylesheet" href="./assets/album.css">

<section>
  <div id="cCarousel">
    <div class="arrow" id="prev"><i class="fa-solid fa-chevron-left"></i></div>
    <div class="arrow" id="next"><i class="fa-solid fa-chevron-right"></i></div>

    <div id="carousel-vp">
      <div id="cCarousel-inner">


        <?php
        // Ouvrez le fichier de log

        // Préparez la requête SQL pour récupérer les albums
        $stmt = $conn->prepare("SELECT * FROM albums");
        $stmt->execute();

        // Parcourez les résultats et affichez chaque album
        while ($album = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<a href="album_details.php?id=' . $album['id'] . '">';
          echo '<article class="cCarousel-item">';
          $image_url = 'http://localhost:8001/' . $album['cover_image_path'];
          echo '<img src="' . $image_url . '" alt="Album cover">';
          echo '</article>';
          echo '</a>';
        }
      



        // Ouvrez le fichier de log

        // Préparez la requête SQL pour récupérer les albums
        $stmt = $conn->prepare("SELECT * FROM albums");
        $stmt->execute();

        // Parcourez les résultats et affichez chaque album
        while ($album = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<article class="cCarousel-item">';
          $image_url = 'http://localhost:8001/' . $album['cover_image_path'];
          echo '<img src="' . $image_url . '" alt="Album cover">';
          echo '</article>';
        }
      

        // Préparez la requête SQL pour récupérer les albums
        $stmt = $conn->prepare("SELECT * FROM albums");
        $stmt->execute();

        // Parcourez les résultats et affichez chaque album
        while ($album = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<article class="cCarousel-item">';
          $image_url = 'http://localhost:8001/' . $album['cover_image_path'];
          echo '<img src="' . $image_url . '" alt="Album cover">';
          echo '</article>';
        }


         // Préparez la requête SQL pour récupérer les albums
         $stmt = $conn->prepare("SELECT * FROM albums");
         $stmt->execute();
 
         // Parcourez les résultats et affichez chaque album
         while ($album = $stmt->fetch(PDO::FETCH_ASSOC)) {
           echo '<article class="cCarousel-item">';
           $image_url = 'http://localhost:8001/' . $album['cover_image_path'];
           echo '<img src="' . $image_url . '" alt="Album cover">';
           echo '</article>';
         }

         // Préparez la requête SQL pour récupérer les albums
         $stmt = $conn->prepare("SELECT * FROM albums");
         $stmt->execute();
 
         // Parcourez les résultats et affichez chaque album
         while ($album = $stmt->fetch(PDO::FETCH_ASSOC)) {
           echo '<article class="cCarousel-item">';
           $image_url = 'http://localhost:8001/' . $album['cover_image_path'];
           echo '<img src="' . $image_url . '" alt="Album cover">';
           echo '</article>';
         }

         // Préparez la requête SQL pour récupérer les albums
         $stmt = $conn->prepare("SELECT * FROM albums");
         $stmt->execute();
 
         // Parcourez les résultats et affichez chaque album
         while ($album = $stmt->fetch(PDO::FETCH_ASSOC)) {
           echo '<article class="cCarousel-item">';
           $image_url = 'http://localhost:8001/' . $album['cover_image_path'];
           echo '<img src="' . $image_url . '" alt="Album cover">';
           echo '</article>';
         }

          // Préparez la requête SQL pour récupérer les albums
        $stmt = $conn->prepare("SELECT * FROM albums");
        $stmt->execute();

        // Parcourez les résultats et affichez chaque album
        while ($album = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<article class="cCarousel-item">';
          $image_url = 'http://localhost:8001/' . $album['cover_image_path'];
          echo '<img src="' . $image_url . '" alt="Album cover">';
          echo '</article>';
        }

         // Préparez la requête SQL pour récupérer les albums
         $stmt = $conn->prepare("SELECT * FROM albums");
         $stmt->execute();
 
         // Parcourez les résultats et affichez chaque album
         while ($album = $stmt->fetch(PDO::FETCH_ASSOC)) {
           echo '<article class="cCarousel-item">';
           $image_url = 'http://localhost:8001/' . $album['cover_image_path'];
           echo '<img src="' . $image_url . '" alt="Album cover">';
           echo '</article>';
         }
         ?>
      </div>
    </div>
  </div>
</section>

</div>
<script src="./assets/album.js"></script>
<?php include('./include/footer.php'); ?>