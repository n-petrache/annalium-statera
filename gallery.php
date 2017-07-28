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
//Affichage du bouton d'ajout d'un personnage si la connexion est faite
   if (isset($_SESSION['pseudoC'])) {
       ?>
       <a class="btn btn-info" href="addPic.php">Ajouter une image</a>
       <?php
   }
   ?>
<div class="container-fluid">
    <?php
    foreach ($picsList as $pic) {
        ?>
       <div>
          <img class="col-xs-12 col-sm-6 col-md-4 col-lg-3" src="assets/img/gallery/<?= $pic->fileName ?>" alt="<?= $pic->fileName ?>"/><br>
          <span><?= $pic->name ?></span>
       </div>
       <?php
   }
   ?>
</div>