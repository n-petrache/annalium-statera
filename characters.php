<h2>Les personnages</h2>
<div class="col-xs-12">
   <form action="index.php?page=characters" method="POST" class="rel-select">
      <select name="religions" onchange="form.submit()">
         <option value="0">Tous les personnages</option>
         <?php
         //On affiche toutes les religions renseignées dans la base de données 
         //dans une liste déroulante qui servira à filtrer les personnages
         foreach ($religionsList as $rel) {
             //Dans l'option on vérifie grâce à une ternaire que 
             //la valeur passée en POST($characters->religionId) est égale à l'option.
             ?>     
             <option value="<?= $rel->id ?>" <?= $rel->id == $characters->religionId ? 'selected' : '' ?>><?= $rel->name ?></option>
             <?php
         }
         ?>
      </select>
   </form>
</div>
<?php
//Affichage du bouton d'ajout d'un personnage 
//si l'utilisateur est connecté
if (isset($_SESSION['pseudoC'])) {
    ?>
    <a class="btn btn-info" href="addChara.php">Ajouter un personnage</a>
    <?php
}
?>
<div class="container-fluid portraits">
    <?php
    //Pour chaque personnage présent dans la base de données 
    //on affiche le protrait et le nom des personnages
    foreach ($charaList as $chara) {
        ?>
       <div class="characters col-xs-12 col-sm-6 col-md-4 col-lg-3">
          <!-- Si le portrait n'est pas renseigné pour un personnage
                c'est un portrait anonyme qui s'affiche (fichier "no-image.png") -->
          <img src="assets/img/portraits/<?= $chara->portraitFile == 'Néant' ? 'no-image.png' : $chara->portraitFile ?>" alt="<?= $chara->firstName ?>"/><br>
          <span><?= $chara->firstName ?></span>
       </div>
       <!-- La div .chara s'affiche avec les données d'un personnage lorsqu'on 
               clique sur le portrait du personnage concerné dans la div .portraits -->
       <div class="chara">
          <h3>
              <?=
              //Si le nom de famille n'est pas renseigné dans 
              //la base de données on n'affiche que le prénom
              $chara->firstName;
              if ($chara->lastName != NULL && $chara->lastName != 'Inconnu') {
                  echo ' ' . $chara->lastName;
              }
              ?>
          </h3>
          <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
             <img class="center-block" src="assets/img/portraits/<?= $chara->portraitFile == NULL || $chara->portraitFile == 'Néant' ? 'no-image.png' : $chara->portraitFile ?>" />
          </div>
          <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
             <!-- Avec des ternaires, on attribue des valeurs "Inconnu(e)" 
             pour les informations du personnage qui ne sont pas déterminées -->
             <p>Age : 
                 <?= $chara->age != NULL && $chara->age != 0 ? $chara->age . ' ans' : 'Inconnu' ?>
             </p>
             <p>Date de naissance : 
                 <?= $chara->birthday != NULL ? $chara->birthday : 'Inconnue' ?>
             </p>
             <p>Signe astrologique : 
                 <?= $chara->astroSign != NULL ? $chara->astroSign : 'Inconnu' ?>
             </p>
             <p>Religion : 
                 <?= $chara->religion != NULL ? $chara->religion : 'Inconnue' ?>
             </p>
             <p>Caste : 
                 <?= $chara->caste != NULL ? $chara->caste : 'Inconnue' ?>
             </p>
             <p>
                 <?= $chara->description != NULL && $chara->description != 'Néant' ? $chara->description : '' ?>
             </p>
             <?php
             //Affichage des boutons de modification et de suppression d'un personnage 
             //si la connexion est faite et qu'il s'agit du compte administrateur (Noya-Mai)
             if (isset($_SESSION['pseudoC']) && $_SESSION['pseudoC'] == 'Noya-Mai') {
                 ?>
                 <a class="btn btn-warning" href="addChara.php?modifyCharaId=<?= $chara->id ?>">Modifier le personnage</a>
                 <a class="btn btn-danger" href="?deleteCharaId=<?= $chara->id ?>">Supprimer le personnage</a> 
                 <?php
             }
             ?>
             <!-- Le bouton "Retour" ferme la div .chara pour revenir à la div .portraits -->
             <p><a class="back"><< Retour</a></p>
          </div>
       </div>
       <?php
   }
   ?>
</div>