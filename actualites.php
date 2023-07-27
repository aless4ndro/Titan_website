<?php
include('./include/header.php');
include('config.php');
?>
<link rel="stylesheet" href="./assets/actualites.css">

<!-- Begin Table -->
<h5 class="text-center">Actualités</h5>
<table class="table">
    <tbody>
        <?php
        // Fetch all actualités
        $req = $conn->query('SELECT * FROM actualites');
        while ($donnees = $req->fetch()) {
        ?>
            <!-- Populate the table with actualités data -->
            <tr class="tr">
                <td><?php echo $donnees['titre']; ?></td>
                <td><?php echo $donnees['contenu']; ?></td>
                <td>
                    <!-- Button trigger modal -->
                    <i class="fas fa-arrow-right" data-mdb-toggle="modal" data-mdb-target="#exampleModal<?php echo $donnees['id']; ?>">

                    </i>

                    <div class="modal fade" id="exampleModal<?php echo $donnees['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $donnees['titre']; ?></h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                    <h6>Date de publication :</h6>
                                    <p><?php echo $donnees['date']; ?></p>

                                    <h6>Contenu :</h6>
                                    <p><?php echo $donnees['contenu']; ?></p>

                                    <img src="<?php echo $donnees['img_illustration']; ?>" alt="Actualite Image" class="img-fluid rounded mx-auto d-block">
                                    <br>
                                    <h6>Rendez-vous sur :</h6>
                                    <p><a href="https://titanbeard.bandcamp.com/" target="_blank" class="text-decoration-none" style="font-size: 1rem;">https://titanbeard.bandcamp.com/</a></p>

                                    <h6>Pour me contacter voici mes coordonées :</h6>
                                    <p style="font-size: 1rem;">- Téléphone : <a href="tel:0232325833" class="text-decoration-none">02 32 32 58 33</a></p>
                                    <p style="font-size: 1rem;">- Email : <a href="mailto:contact@titan-beard.com" class="text-decoration-none">contact@titan-beard.com</a></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<!-- End Table -->

<?php include('./include/footer.php'); ?>