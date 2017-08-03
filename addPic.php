<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'config.php';
include_once 'class/database.php';
include_once 'model/users.php';
include_once 'model/pictures.php';
include_once 'model/categories.php';
include_once 'lang/FR_FR.php';
include_once 'controller/inscriptionCtrl.php';
include_once 'controller/connectionCtrl.php';
include_once 'controller/galleryCtrl.php';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
      <title>Ajouter une image | Annalium Statera</title>
   </head>
   <body>
      <form name="addPic" action="index.php?page=writings" method="POST">
         <div class="col-xs-12 form-group <?= isset($errorList['name']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="name">Nom de l'image : *</label>
            <div class="col-lg-8">
               <input type="text" class="form-control" name="name" id="title" value="<?= $pictures->name ?>" required>
               <p class="help-block"><?= isset($errorList['name']) ? $errorList['name'] : '' ?></p>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['fileName']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="fileName">Fichier : *</label>
            <div class="col-lg-8">
               <input type="text" class="form-control" name="fileName" id="fileName" value="<?= $pictures->fileName ?>" required>
               <p class="help-block"><?= isset($errorList['fileName']) ? $errorList['fileName'] : '' ?></p>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['category']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="category">Catégorie : *</label>
            <div class="col-lg-8">
               <select name="category" id="category" class="form-control">
                   <?php
                   foreach ($categoriesList as $category) {
                       //Dans l'option on vérifie grâce à un ternaire que la valeur 
                       //passée en POST($pictures->categoryId) est égale à l'option.
                       ?>     
                      <option value="<?= $category->id ?>" <?= $category->id == $pictures->categoryId ? 'selected' : '' ?>><?= $category->name ?></option>
                      <?php
                  }
                  ?>
               </select>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['description']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="description">Description : *</label>
            <div class="col-lg-8">
               <textarea maxlength="500" type="text" class="form-control" name="description" id="description" required><?= $pictures->description ?></textarea>
               <p class="help-block"><?= isset($errorList['description']) ? $errorList['description'] : '' ?></p>
            </div>
         </div>
         <input type="hidden" name="id" value="<?= $pictures->id ?>" />
         <input type="submit" name="addPic" value="Soumettre"/>
      </form>
   </body>
</html>