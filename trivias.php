<h2>Trivias</h2>
<div class="">
    <?php
    if (isset($_SESSION['pseudoC']) && $_SESSION['pseudoC'] == 'Noya-Mai') {
        ?>
       <a class="btn btn-info" href="addTrivia.php">Ajouter une anecdote</a>
       <?php
   }
   foreach ($triviasList as $trivia) {
       ?>
       <h3><?= $trivia->title ?></h3>
       <p><?= $trivia->description ?></p>
       <?php
       if (isset($_SESSION['pseudoC']) && $_SESSION['pseudoC'] == 'Noya-Mai') {
           ?>
           <a class="btn btn-warning modifTriviaBtn" href="addTrivia.php?modifyTriviaId=<?= $trivia->id ?>">Editer</a>
           <a class="btn btn-danger" href="?deleteTriviaId=<?= $trivia->id ?>">Supprimer</a>
           <?php
       }
   }
   ?>
</div>