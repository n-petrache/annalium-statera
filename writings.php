<h2>Récits</h2>
<?php
//Affichage du bouton d'ajout d'un récit si la connexion est faite
if (isset($_SESSION['pseudoC'])) {
    ?>
<a class="btn btn-info" href="addWriting.php">Ajouter un récit</a>
    <?php
}
?>
<div class="container-fluid">
    <?php
    //Pour chaque récit contenu dans la base de données 
    //on affiche le titre sous une icône qui fait office de lien 
    //vers un affichage du pdf du récit
    foreach ($writingsList as $text) {
        ?>
       <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style="text-align: center">
          <a href="assets/docs/<?= $text->fileName ?>">
             <img class="col-xs-12" src="assets/img/pdf.png" alt="<?= $text->fileName ?>"/>
          </a>
          <span><?= $text->title ?></span>
          <?php
          //Si l'utilisateur est connecté et qu'il s'agit de l'administrateur (Noya-Mai)
          if (isset($_SESSION['pseudoC']) && $_SESSION['pseudoC'] == 'Noya-Mai') {
              //Un bouton de suppression apparaît pour chaque récit
              ?>
              <a class="btn btn-danger" href="?deleteWritingId=<?= $text->id ?>">Supprimer</a>
              <?php
          }
          ?>
       </div>
       <?php
   }
   ?>
</div>