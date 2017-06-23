<?php
$pseudo = '';
$birthDate = '';
$email = '';
if (isset($_POST['pseudo'])) {
    $pseudo = $_POST['pseudo'];
} elseif (isset($_GET['pseudo'])) {
    $pseudo = $_GET['pseudo'];
}
if (isset($_POST['birthDate'])) {
    $birthDate = $_POST['birthDate'];
} elseif (isset($_GET['birthDate'])) {
    $birthDate = $_GET['birthDate'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
} elseif (isset($_GET['email'])) {
    $email = $_GET['email'];
}
$pseudo = strip_tags($pseudo);
$age = strip_tags($age);

$pseudoReg = preg_match('#^[ÀÁÂÃÄÅĂÂÇÈÉÊËÌÍÎÏÎÑÒÓÔÕÖØȘȚÙÚÛÜÝ]*[a-zàáâãäåăâçèéêëìíîïîðñòóôõöøșțùúûüýÿ]+(-? ?[ÀÁÂÃÄÅĂÂÇÈÉÊËÌÍÎÏÎÑÒÓÔÕÖØȘȚÙÚÛÜÝ]?[a-zàáâãäåăâççèéêëìíîïîðñòóôõöøșțùúûüýÿ])*[0-9]*#i', $pseudo);
$birthDateReg = preg_match('#^([0-9]{2}[-\/. ]{1}){2}[0-9]{4}$#', $birthDate);
$emailReg = preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email);
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8"/>
      <title>Inscription</title>
   </head>
   <body>
       <?php
       if ($pseudo != '' && $birthDate != '' && $email != '') {
           if ($pseudoReg && $birthDateReg && $emailReg) {
               ?>
      <!--Inscription confirmée-->
               <?php
           } else {
               ?>
              <p>Veuillez remplir tous les champs correctement.</p>
              <form method="POST" action="inscription.php">
                 <p>
                    <label for="pseudo">Pseudo :</label><br>
                    <input name="pseudo" placeholder="Votre pseudo" value="<?= $pseudo ?>"/>
                 </p>
                 <p>
                    <label for="birthDate">Date de naisance :</label><br>
                    <input name="birthDate" placeholder="Votre date de naissance" value="<?= $birthDate ?>"/>
                 </p>
                 <p>
                    <label for="email">Email :</label><br>
                    <input name="email" placeholder="Votre email" value="<?= $email ?>"/>
                 </p>
                 <input type="submit" value="Valider"/>
              </form>
              <?php
          }
      } else {
          ?>
          <form method="POST" action="inscription.php">
             <p>
                <label for="pseudo">Pseudo :</label><br>
                <input name="pseudo" placeholder="Votre pseudo" value=""/>
             </p>
             <p>
                <label for="birthDate">Date de naissance :</label><br>
                <input name="birthDate" placeholder="Votre date de naissance" value=""/>
             </p>
             <p>
                <label for="email">Email :</label><br>
                <input name="email" placeholder="Votre email" value=""/>
             </p>
             <input type="submit" value="Valider"/>
          </form>
          <?php
      }
      ?>
   </body>
</html>

