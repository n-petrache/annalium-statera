<h2>Galerie d'images</h2>
<div class="col-lg-12">
   <form action="index.php?page=gallery" method="POST" class="rel-select">
      <select name="categories" onchange="form.submit()">
         <option value="0">Toutes les catégories</option>
         <?php
         foreach ($categoriesList as $cat) {
             //Dans l'option on vérifie grâce à un ternaire que la valeur passée en POST($pictures->categoryId) est égale à l'option.
             ?>     
             <option value="<?= $cat->id ?>" <?= $cat->id == $pictures->categoryId ? 'selected' : '' ?>><?= $cat->name ?></option>
             <?php
         }
         ?>
      </select>
   </form>
</div>
<?php
//Affichage du bouton d'ajout d'une image si la connexion est faite
if (isset($_SESSION['pseudoC'])) {
    ?>
    <a class="btn btn-info" href="addPic.php">Ajouter une image</a>
    <?php
}
?>
<div class="container-fluid">
    <?php
    //Pour chaque image renseignée dans la base de donnée on affiche 
    //une miniature avec le nom en dessous
    //Si on clique sur la miniature, on affiche l'image en taille réelle
    foreach ($picsList as $pic) {
        ?>
       <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style="text-align: center">
          <a href="assets/img/gallery/<?= $pic->fileName ?>">
             <img class="col-xs-12" src="assets/img/gallery/<?= $pic->fileName ?>" alt="<?= $pic->fileName ?>"/>
          </a>
          <span><?= $pic->name ?></span>
          <?php
          //Si l'utilisateur est connecté et qu'il s'agit de l'administrateur (Noya-Mai)
          //Un bouton de suppression s'affiche pour chaque image
          if (isset($_SESSION['pseudoC']) && $_SESSION['pseudoC'] == 'Noya-Mai') {
              ?>
              <a class="btn btn-danger" href="?deletePicId=<?= $pic->id ?>">Supprimer</a>
              <?php
          }
          ?>
       </div>
       <?php
   }
   ?>
</div>