<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'config.php';
include_once 'class/database.php';
include_once 'model/users.php';
//include_once 'model/characters.php';
include_once 'controller/inscriptionCtrl.php';
include_once 'controller/connectionCtrl.php';
//include_once $lang;
/* Si les champs du formulaire ne sont pas vides, 
 * les cookies créés stockent les infos renseignées */
$_SESSION['pseudoC'] = $users->login;
if (isset($_POST['pseudoC']) && isset($_POST['passwordC'])) { //path, domain, secure, httponly (search setcookie on php.net)
    setcookie('login', $_POST['pseudoC'], time() + 365 * 24 * 3600, '/', null, false, true);
    setcookie('password', $_POST['passwordC'], time() + 365 * 24 * 3600, '/', null, false, true);
}
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
      <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
      <link href="assets/css/navbar.css" rel="stylesheet" type="text/css"/>
      <title><?= $xml->page[$pageNumber]->title ?></title>
   </head>
   <body>
      <header>
         <h1 id="main-title" style="font-size: 75px;">Annalium Statera</h1>
      </header>
      <div role="banner" class="navbar navbar-fixed-top navbar-inverse">
         <div class="container">
            <div class="navbar-header">
               <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
            </div>
            <div class="navbar-inverse side-collapse in">
               <nav role="navigation" class="navbar-collapse">
                  <ul class="nav navbar-nav">
                     <li><a href="home.html" class="glyphicon glyphicon-home"></a></li>
                     <li><a href="#">Récits</a></li>
                     <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="dissidents.html">
                           Personnages<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                           <li><a href="#">Equilibrés</a></li>
                           <li><a href="#">Eveillés</a></li>
                           <li><a href="#">Dissidents</a></li>
                           <li><a href="#">Autres</a></li>
                           <li><a href="characters.html">Tous</a></li>
                        </ul>
                     </li>
                     <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Galerie
                           <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="#">Personnages</a></li>
                           <li><a href="#">Lieux</a></li>
                           <li><a href="#">Scènes</a></li>
                        </ul>
                     </li>
                     <li><a href="#">Références</a></li>
                  </ul>
               </nav>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="main">
            <div id="top-bar">
               <!-- Trigger the modal with a button -->
               <div class="btn-group">
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#connection">Connexion</button>
                  <?php
                  //Affichage du message de bienvenue si la connexion est réussie
                  if ($connectionOk) {
                      ?>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#inscription">Inscription</button>
                      <?php
                  }
                  ?>
               </div>
               <?php
               //Affichage du message de bienvenue si la connexion est réussie
               if ($connectionOk) {
                   ?>
                   <p id="welcome">Bienvenue <?= $users->login ?></p>
                   <?php
               }
               ?>

               <!-- Modal -->
               <div class="modal fade" id="connection" role="dialog">
                  <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">Connexion</h4>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <form method="POST" action="#">
                                 <div class="row">
                                    <div class="col-sm-offset-1 col-sm-3 text-center">
                                       <label for="pseudoC">Pseudo :</label>
                                    </div>
                                    <div class="col-sm-offset-0 col-sm-4 col-xs-offset-2">
                                       <input type="text" name="pseudoC" placeholder="" id="pseudoC" class="col-xs-10 col-sm-12">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-offset-1 col-sm-3 text-center">
                                       <label for="passwordC">Mot de passe :</label>
                                    </div>
                                    <div class="col-sm-offset-0 col-sm-4 col-xs-offset-2">
                                       <input type="password" pattern=".{4,}" name="passwordC" id="passwordC" class="col-xs-10 col-sm-12">
                                    </div>
                                 </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary" name="connection">Ok</button>
                           </form>
                        </div>
                     </div>

                  </div>
               </div>
               <div class="modal fade" id="inscription" role="dialog">
                  <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">Inscription</h4>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <form method="POST" action="index.php">
                                 <div class="row">
                                    <div class="col-xs-offset-1 col-sm-3">
                                       <label for="pseudoI">Pseudo :</label>
                                    </div>
                                    <div class="col-sm-offset-0 col-sm-4 col-xs-offset-2">
                                       <input type="text" name="pseudoI" placeholder="" id="pseudoI" class="col-xs-10 col-sm-12">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xs-offset-1 col-sm-3">
                                       <label for="passwordI">Mot de passe :</label>
                                    </div>
                                    <div class="col-sm-offset-0 col-sm-4 col-xs-offset-2">
                                       <input type="password" pattern=".{4,}" name="passwordI" id="passwordI" class="col-xs-10 col-sm-12">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xs-offset-1 col-sm-3">
                                       <label for="confirmPasswordI">Confirmer :</label>
                                    </div>
                                    <div class="col-sm-offset-0 col-sm-4 col-xs-offset-2">
                                       <input type="password" pattern=".{4,}" name="confirmPasswordI" id="confirmPasswordI" class="col-xs-10 col-sm-12">
                                    </div>
                                 </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary" name="save">Ok</button>
                           </form>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
            <div id="main-window" class="col-md-offset-1 col-md-10">
               <?= $xml->page[$pageNumber]->content ?>
            </div>
            <!--<img id="Noya" src="assets/img/wind.png" alt="Noya-Maï"/>-->
         </div>
      </div>
      <footer>
         <!--<a href="http://www.facebook.com/pages/Les-travaux-de-Noya-Mai/105929299457053" target="_blank" title="Les travaux de Noya-Maï" id="lien">
            <div id="btn-lien">Les travaux<br>de<br>Noya-Maï</div>
         </a>-->
         <span>&copy; Noya-Maï</span>
      </footer>
      <!-- -->
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="assets/js/script.js" type="text/javascript"></script>
   </body>
</html>
