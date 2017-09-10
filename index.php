<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'config.php';
include_once 'class/database.php';
include_once 'model/users.php';
include_once 'model/writings.php';
include_once 'model/characters.php';
include_once 'model/astroSigns.php';
include_once 'model/religions.php';
include_once 'model/castes.php';
include_once 'model/pictures.php';
include_once 'model/categories.php';
include_once 'model/trivias.php';
include_once 'lang/FR_FR.php';
include_once 'controller/inscriptionCtrl.php';
include_once 'controller/connectionCtrl.php';
include_once 'controller/writingsCtrl.php';
include_once 'controller/charaCtrl.php';
include_once 'controller/addCharaCtrl.php';
include_once 'controller/triviasCtrl.php';
include_once 'controller/galleryCtrl.php';
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
      <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
      <link href="assets/css/navbar.css" rel="stylesheet" type="text/css"/>
      <link href="assets/css/characters.css" rel="stylesheet" type="text/css"/>
      <title>Annalium Statera</title>
   </head>
   <body>
      <div id="fb-root"></div>
      <script>
//          (function (d, s, id) {
//              var js, fjs = d.getElementsByTagName(s)[0];
//              if (d.getElementById(id))
//                  return;
//              js = d.createElement(s);
//              js.id = id;
//              js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.9";
//              fjs.parentNode.insertBefore(js, fjs);
//          }(document, 'script', 'facebook-jssdk'));
      </script>
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
                     <li><a href="?page=main" class="glyphicon glyphicon-home"> Accueil</a></li>
                     <li><a href="?page=writings">Récits</a></li>
                     <li><a href="?page=characters">Personnages</a></li>
                     <li><a href="?page=gallery">Galerie</a></li>
                     <li><a href="?page=trivias">Trivias</a></li>
                  </ul>
               </nav>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="main">
            <div id="top-bar">
               <!-- Trigger the modal with a button -->
               <?php
               //Affichage du bouton de connexion si celle-ci n'est pas encore effectuée
               if (!isset($_SESSION['pseudoC'])) {
                   ?>
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#connection">Connexion</button>
                   <?php
               }
               if (isset($_SESSION['pseudoC'])) {
                   ?>
                   <a class="btn btn-primary" href="?logout" name="disconnection">Déconnexion</a>
                   <?php
               }
               //Affichage du bouton d'inscription d'un nouveau membre si la connexion est réussie 
               //et qu'il s'agit du compte administrateur
               if (isset($_SESSION['pseudoC']) && $_SESSION['pseudoC'] == 'Noya-Mai') {
                   ?>
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inscription">Inscrire un nouveau membre</button>
                   <?php
               }
               //Affichage du message de bienvenue si la connexion est réussie
               if (isset($_SESSION['pseudoC'])) {
                   ?>
                   <p id="welcome">Bienvenue <?= $_SESSION['pseudoC'] ?></p>
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
                              <form method="POST" action="#?login">
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
                              <form method="POST" action="#">
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
                                 <input type="hidden" name="groupId" id="groupId" value="2" />
                                 <input type="hidden" name="id" id="groupId" value="<?= $users->id ?>" />
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary" name="subscribe">Ok</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="main-window" class="col-md-offset-1 col-md-10">
               <?php
               $page = isset($_GET['page']) ? $_GET['page'] : "main";
               $page_name = $page . ".php";
               $rep = "./";
               $dir = opendir($rep);
               $page_exist = 0;
               while (FALSE !== ($file = readdir($dir))) {
                   if ($file == $page_name) {
                       $page_exist = 1;
                   }
               }
               if ($page_exist == 1) {
                   include_once($page_name);
               } else {
                   include_once("main.php");
               }
               ?>
            </div>
            <!--<img id="Noya" src="assets/img/wind.png" alt="Noya-Maï"/>-->
         </div>
      </div>
      <footer>
         <!--<div class="fb-share-button" data-href="index.php" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Ftp%2Findex.php%2F&amp;src=sdkpreparse">Partager</a></div>
         <a href="http://www.facebook.com/pages/Les-travaux-de-Noya-Mai/105929299457053" target="_blank" title="Les travaux de Noya-Maï" id="lien">
                     <div id="btn-lien">Les travaux<br>de<br>Noya-Maï</div>
                  </a>-->
         <span>&copy; Noya-Maï</span>
      </footer>
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="assets/js/script.js" type="text/javascript"></script>
      <!--<script src=’http://static.ak.fbcdn.net/connect.php/js/FB.Share’ type=’text/javascript’/>-->
   </body>
</html>
<?php
?>
