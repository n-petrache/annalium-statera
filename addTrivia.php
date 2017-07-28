<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'config.php';
include_once 'class/database.php';
include_once 'model/users.php';
include_once 'model/trivias.php';
include_once 'lang/FR_FR.php';
include_once 'controller/inscriptionCtrl.php';
include_once 'controller/connectionCtrl.php';
include_once 'controller/triviasCtrl.php';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>Ajouter/modifier une anecdote | Annalium Statera</title>
   </head>
   <body>
      <form name="addTrivia" action="index.php?page=trivias" method="POST">
         <div class="col-xs-12 form-group <?= isset($errorList['title']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="title">Titre : *</label>
            <div class="col-lg-8">
               <input type="text" class="form-control" name="title" id="title" value="<?= $trivias->title ?>" required>
               <p class="help-block"><?= isset($errorList['title']) ? $errorList['title'] : '' ?></p>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['description']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="description">Description : *</label>
            <div class="col-lg-8">
               <textarea maxlength="500" type="text" class="form-control" name="description" id="description" required><?= $trivias->description ?></textarea>
               <p class="help-block"><?= isset($errorList['description']) ? $errorList['description'] : '' ?></p>
            </div>
         </div>
         <input type="hidden" name="id" value="<?= $trivias->id ?>" />
         <input type="submit" name="addTrivia" value="Soumettre"/>
      </form>
   </body>
</html>
