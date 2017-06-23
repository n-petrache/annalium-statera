<?php
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'model/users.php';
include_once 'model/characters.php';
include_once 'controller/indexCtrl.php';
include_once $lang;
?>
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
      <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
      <link href="assets/css/navbar.css" rel="stylesheet" type="text/css"/>
      <title>Annalium Satera</title>
   </head>
   <body>
      <header>
         <h1 style="font-size: 70px;">Annalium Statera</h1>
      </header>
      <div role="banner" class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="navbar-inverse side-collapse in">
          <nav role="navigation" class="navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="#">Accueil</a></li>
              <li><a href="#">Chapitres</a></li>
              <li><a href="#">Personnages</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
      <div class="container">
         <div class="main">
            <div id="top-bar">
               <span>Main</span>
            </div>
            <div id="main-window">
               <div id="intro" class="content">
                  <span><u>Synopsis</u></span>
                  <p>
                     Depuis la nuit des temps, l'équilibre est assuré par deux forces inébranlables
                     échouées sur la Terre et qui ont permis l'émergence de la vie.
                  </p>
                  <p>
                     Avec l'évolution, ces deux forces se sont incarnées en prenant forme humaine
                     et assurent leur pérennité par la constitution de deux dynasties dont les premiers
                     héritiers connus sont <b>Daiken</b> &amp; <b>Andra</b>.
                     Ces mêmes noms deviendront les patronymes des dynasties pour toutes les générations à venir.
                  </p>
                  <p>
                     Mais au XXe siècle, un événement dramatique poussera les héritiers à changer de
                     noms ; <b>Daiken</b> devenant <b>Parker</b> et <b>Andra</b> devenant <b>Kayazaki</b>.
                  </p>
               </div>
               <div id="taka" class="content">
                  <img src="assets/img/portraits/pazzia.png" alt="Pazzia"/>
                  <!--<img src="assets/img/takaDoll.png" alt="Takahomé &amp; doll">-->
               </div>
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
      <script src="https://code.angularjs.org/1.6.3/angular-route.js"></script>
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="assets/js/script.js" type="text/javascript"></script>
   </body>
</html>
