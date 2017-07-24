<?php
//Incusion du model et du controller
include_once 'model/users.php';
include_once 'controllers/connectionCtrl.php';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8"/>
      <title>Connexion</title>
   </head>
   <body>
        <?php
        //Affichage du message de bienvenue si la connexion est réussie
        if ($isOk) {
            ?>
            <p>Bienvenue <?php echo $user->login ?></p>
            <?php
        }
        ?>
          <form method="POST" action="connection.php">
             <p>
                <label for="login">Pseudo :</label><br>
                <input name="login" placeholder="Votre pseudo" value="" id="login"/>
             </p>
             <p>
                <label for="password">Mot de passe :</label><br>
                <input name="password" placeholder="Votre mot de passe" value="" id="password"/>
             </p>
             <input type="submit" value="Valider"/>
          </form>
   </body>
</html>
