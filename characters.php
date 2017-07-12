<h2>Les personnages</h2>
<div class="col-xs-12">
   <form action="?page=characters" method="POST" class="rel-select">
      <select name="religions" onchange="form.submit()">
         <option value="0">Tous les personnages</option>
         <?php
         foreach ($religionsList as $religion) {
             //Dans l'option on vérifie grâce à un ternaire que la valeur passée en POST($characters->religionId) est égale à l'option.
             ?>     
             <option value="<?= $religion->id ?>" <?= $religion->id == $characters->religionId ? 'selected' : '' ?>><?= $religion->name ?></option>
             <?php
         }
         ?>
      </select>
   </form>
</div>
<?php
//Affichage du bouton d'ajout d'un personnage si la connexion est faite
if (isset($_SESSION['pseudoC'])) {
    ?>
    <a href="addChara.php">Ajouter un personnage</a>
    <?php
}
?>
<div class="content portraits">
    <?php
    foreach ($charaList as $chara) {
        ?>
       <div class="characters col-xs-12 col-lg-offset-1 col-lg-2">
          <img src="assets/img/portraits/<?= $chara->portraitFile ?>" alt="<?= $chara->firstName ?>"/><br>
          <span><?= $chara->firstName ?></span>
       </div>
       <div id="chara">
          <h3><?=
              $chara->firstName;
              if ($chara->lastName != NULL && $chara->lastName != 'Inconnu') {
                  echo ' ' . $chara->lastName;
              }
              ?></h3>
          <img src="assets/img/portraits/<?= $chara->portraitFile ?>" />
          <p>Age : 
              <?php
              if ($chara->age != NULL && $chara->age != 0) {
                  echo $chara->age . ' ans';
              } else {
                  echo 'Inconnu';
              }
              ?>
          </p>
          <p>Date de naissance : 
              <?=
              $chara->birthday;
              if ($chara->birthday == NULL) {
                  echo 'Inconnue';
              }
              ?>
          </p>
          <p>Signe astrologique : 
              <?=
              $chara->astroSign;
              if ($chara->astroSign == NULL) {
                  echo 'Inconnu';
              }
              ?>
          </p>
          <p>Religion : 
              <?=
              $chara->religion;
              if ($chara->religion == NULL) {
                  echo 'Inconnue';
              }
              ?>
          </p>
          <p>Caste : 
              <?=
              $chara->caste;
              if ($chara->caste == NULL) {
                  echo 'Inconnue';
              }
              ?>
          </p>
          <p><?php
              if ($chara->description == NULL || $chara->description == 'Néant') {
                  echo '';
              }
              ?></p>
          <?php
          //Affichage du bouton de modification d'un personnage si la connexion est faite
          if (isset($_SESSION['pseudoC'])) {
              ?>
              <a class="btn btn-warning" href="addChara.php?modifyId=<?= $chara->id ?>">Modifier le personnage</a>
              <a class="btn btn-danger" href="?deleteId=<?= $chara->id ?>">Supprimer le personnage</a> 
              <?php
          }
          ?>
          <a class="back"><< Back</a>
       </div>
       <?php
   }
   ?>
</div>