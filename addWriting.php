<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'config.php';
include_once 'class/database.php';
include_once 'model/users.php';
include_once 'model/writings.php';
include_once 'lang/FR_FR.php';
include_once 'controller/inscriptionCtrl.php';
include_once 'controller/connectionCtrl.php';
include_once 'controller/writingsCtrl.php';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>Ajouter un récit | Annalium Statera</title>
   </head>
   <body>
      <form name="addWriting" action="index.php?page=writings" method="POST">
         <div class="col-xs-12 form-group <?= isset($errorList['title']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="title">Titre : *</label>
            <div class="col-lg-8">
               <input type="text" class="form-control" name="title" id="title" value="<?= $writings->title ?>" required>
               <p class="help-block"><?= isset($errorList['title']) ? $errorList['title'] : '' ?></p>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['fileName']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="fileName">Fichier : *</label>
            <div class="col-lg-8">
               <input type="text" class="form-control" name="fileName" id="fileName" value="<?= $writings->fileName ?>" required>
               <p class="help-block"><?= isset($errorList['fileName']) ? $errorList['fileName'] : '' ?></p>
            </div>
         </div>
         <input type="hidden" name="id" value="<?= $writings->id ?>" />
         <input type="submit" name="addWriting" value="Soumettre"/>
      </form>
   </body>
</html>
