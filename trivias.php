<h2>Trivias</h2>
<div class="">
    <?php
    foreach ($triviasList as $trivia) {
        ?>
       <h3><?= $trivia->title ?></h3>
       <p><?= $trivia->description ?></p>
       <?php
       if (isset($_SESSION['pseudoC'])) {
           ?>
           <div class="modifTrivia">
              <form action="?page=trivias" method="POST">
                 <textarea maxlength="500" type="text" name="description" id="description" required><?= $trivia->description ?></textarea>
                 <input type="submit" name="modifTriviaId" value="Modifier"/>
              </form>
           </div>
       <div class="btn btn-warning modifTriviaBtn" onclick="showEdit(this.previousElementSibling)">Editer</div>
           <a class="btn btn-danger" href="?deleteTriviaId=<?= $trivia->id ?>">Supprimer</a>
           <?php
       }
   }
   ?>
</div>