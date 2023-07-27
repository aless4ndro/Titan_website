<?php
include('config.php');
include('./include/header.php');
?>

<link rel="stylesheet" href="./assets/titan_beard.css">
<div class="card text-center">
    <div class="card-body" style="background: url('./images/2019 08 23 - SORTIE TOUR EIFFEL (11) 2.png') center center / cover no-repeat">
        <div class="overlay">
            <div class="apropos">à propos de l’artiste
                <div class="tristan">tristan</div>
                <div class="beard">beard</div>
                <div class="right-border"></div>
                <div class="border-one"></div>
                <div class="border-two"></div>
                <div class="border-three"></div>
            </div>
        </div>
    </div>
    <?php include('global_player.php');
        echo '<div class="music-icon"><i class=\'bx bxs-music\'></i></div>';
        ?>
</div>


<?php include('./include/footer.php');
