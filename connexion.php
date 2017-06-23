<?php
$pseudo = '';
$password = '';
if (isset($_POST['pseudo'])) {
    $pseudo = $_POST['pseudo'];
} elseif (isset($_GET['pseudo'])) {
    $pseudo = $_GET['pseudo'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
} elseif (isset($_GET['password'])) {
    $password = $_GET['password'];
}
$pseudo = strip_tags($pseudo);
$password = strip_tags($password);

$pseudoReg = preg_match('#^[ÀÁÂÃÄÅĂÂÇÈÉÊËÌÍÎÏÎÑÒÓÔÕÖØȘȚÙÚÛÜÝ]*[a-zàáâãäåăâçèéêëìíîïîðñòóôõöøșțùúûüýÿ]+(-? ?[ÀÁÂÃÄÅĂÂÇÈÉÊËÌÍÎÏÎÑÒÓÔÕÖØȘȚÙÚÛÜÝ]?[a-zàáâãäåăâççèéêëìíîïîðñòóôõöøșțùúûüýÿ])*[0-9]*#i', $pseudo);
$passwordReg = preg_match('##', $password);
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8"/>
      <title>Connexion</title>
   </head>
   <body>
       <?php
       if ($pseudo != '' && $password != '') {
           if ($pseudoReg && $passwordReg) {
               ?>
      <!--Connexion confirmée-->
               <?php
           } else {
               ?>
              <p>Veuillez remplir tous les champs correctement.</p>
              <form method="POST" action="connexion.php">
                 <p>
                    <label for="pseudo">Pseudo :</label><br>
                    <input name="pseudo" placeholder="Votre pseudo" value="<?= $pseudo ?>"/>
                 </p>
                 <p>
                    <label for="password">Mot de passe :</label><br>
                    <input name="password" placeholder="Votre mot de passe" value="<?= $password ?>"/>
                 </p>
                 <input type="submit" value="Valider"/>
              </form>
              <?php
          }
      } else {
          ?>
          <form method="POST" action="connexion.php">
             <p>
                <label for="pseudo">Pseudo :</label><br>
                <input name="pseudo" placeholder="Votre pseudo" value=""/>
             </p>
             <p>
                <label for="password">Mot de passe :</label><br>
                <input name="password" placeholder="Votre mot de passe" value=""/>
             </p>
             <input type="submit" value="Valider"/>
          </form>
          <?php
      }
      ?>
   </body>
</html>
