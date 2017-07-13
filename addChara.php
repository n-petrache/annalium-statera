<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'config.php';
include_once 'class/database.php';
include_once 'model/users.php';
include_once 'model/characters.php';
include_once 'model/astroSigns.php';
include_once 'model/religions.php';
include_once 'model/castes.php';
include_once 'lang/FR_FR.php';
include_once 'controller/inscriptionCtrl.php';
include_once 'controller/connectionCtrl.php';
include_once 'controller/charaCtrl.php';
include_once 'controller/addCharaCtrl.php';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
      <link href="assets/css/addChara.css" rel="stylesheet" type="text/css"/>
      <title>Ajouter/modifier un personnage | Annalium Statera</title>
   </head>
   <body>
      <h2>Ajouter/modifier un personnage</h2>
      <a class="btn btn-primary" href="/">Retour</a>
      <form name="addChara" method="POST" action="index.php?page=characters" enctype="multipart/form-data" class="form-vertical">
         <div class="col-xs-12 form-group <?= isset($errorList['lastName']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="lastName">Nom : *</label>
            <div class="col-lg-8">
               <input type="text" class="form-control" name="lastName" id="lastName" value="<?= $characters->lastName ?>" required>         
               <p class="help-block"><?= isset($errorList['lastName']) ? $errorList['lastName'] : '' ?></p>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['firstName']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="firstName">Prénom : *</label>
            <div class="col-lg-8">
               <input type="text" class="form-control" name="firstName" id="firstName" value="<?= $characters->firstName ?>" required>
               <p class="help-block"><?= isset($errorList['firstName']) ? $errorList['firstName'] : '' ?></p>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['age']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="age">Age : *</label>
            <div class="col-lg-8">
               <input type="text" class="form-control" name="age" id="age" value="<?= $characters->age ?>" required>
               <p class="help-block"><?= isset($errorList['age']) ? $errorList['age'] : '' ?></p>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['birthday']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="birthday">Date de naissance : *</label>
            <div class="col-lg-8">
               <input type="text" class="form-control" name="birthday" id="birthday" value="<?= $characters->birthday ?>" required>
               <p class="help-block"><?= isset($errorList['birthday']) ? $errorList['birthday'] : '' ?></p>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['astroSign']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="astroSign">Signe astrologique : *</label>
            <div class="col-lg-8">
               <select name="astroSign" id="astroSign" class="form-control">
                   <?php
                   foreach ($astroSignsList as $astro) {
                       //Dans l'option on vérifie grâce à un ternaire que la valeur passée en POST($characters->id_tppdo1_departments) est égale à l'option.
                       ?>     
                      <option value="<?= $astro->id ?>" <?= $astro->id == $characters->astroSignId ? 'selected' : '' ?>><?= $astro->name ?></option>
                      <?php
                  }
                  ?>
               </select>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['religion']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="religion">Religion : *</label>
            <div class="col-lg-8">
               <select name="religion" id="religion" class="form-control">
                   <?php
                   foreach ($religionsList as $religion) {
                       //Dans l'option on vérifie grâce à un ternaire que la valeur passée en POST($characters->id_tppdo1_departments) est égale à l'option.
                       ?>     
                      <option value="<?= $religion->id ?>" <?= $religion->id == $characters->religionId ? 'selected' : '' ?>><?= $religion->name ?></option>
                      <?php
                  }
                  ?>
               </select>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['caste']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="caste">Caste : *</label>
            <div class="col-lg-8">
               <select name="caste" id="caste" class="form-control">
                   <?php
                   foreach ($castesList as $caste) {
                       //Dans l'option on vérifie grâce à un ternaire que la valeur passée en POST($characters->id_tppdo1_departments) est égale à l'option.
                       ?>     
                      <option value="<?= $caste->id ?>" <?= $caste->id == $characters->casteId ? 'selected' : '' ?>><?= $caste->name ?></option>
                      <?php
                  }
                  ?>
               </select>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['portraitFile']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="portraitFile">Nom du fichier portrait : *</label>
            <div class="col-lg-8">
               <input type="text" class="form-control" name="portraitFile" id="portraitFile" value="<?= $characters->portraitFile ?>" required>
               <p class="help-block"><?= isset($errorList['portraitFile']) ? $errorList['portraitFile'] : '' ?></p>
            </div>
         </div>
         <div class="col-xs-12 form-group <?= isset($errorList['description']) ? 'has-error' : '' ?>">
            <label class="control-label col-lg-offset-1 col-lg-2" for="description">Description : *</label>
            <div class="col-lg-8">
               <textarea maxlength="500" type="text" class="form-control" name="description" id="description" required><?= $characters->description ?></textarea>
               <p class="help-block"><?= isset($errorList['description']) ? $errorList['description'] : '' ?></p>
            </div>
         </div>
         <input type="hidden" name="id" value="<?= $characters->id ?>" />
         <div class="col-xs-12 form-group">
            <input type="submit" name="register" value="Soumettre" class="form-control"/>
         </div>
      </form>
   </body>
</html>