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
    foreach ($writingsList as $text) {
        ?>
       <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style="text-align: center">
          <a href="assets/docs/<?= $text->fileName ?>">
             <img class="col-xs-12" src="assets/img/pdf.png" alt="<?= $text->fileName ?>"/>
          </a>
          <span><?= $text->title ?></span>
          <?php
          if (isset($_SESSION['pseudoC']) && $_SESSION['pseudoC'] == 'Noya-Mai') {
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