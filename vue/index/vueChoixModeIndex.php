<h1 id="mainhead">Choisissez votre mode de jeu !</h1>
<hr>
<div class="row">
  <div class="col-md-6">
    <form method="post" action="jouer.php">
      <input type="image" src="<?= VIEW_PATH_BASE; ?>index/img/humanoide.png" class="img-responsive center-block" alt="submit"/>
    </form>
    <div class="caption">
      <h3>Joueur humanoïde</h3>
    </div>
  </div>
  <div class="col-md-6">
    <form method="post" action="jouerIA.php">
      <input type="image" src="<?= VIEW_PATH_BASE; ?>index/img/glados.png" class="img-responsive center-block" alt="submit"/>
    </form>
    <div class="caption">
      <h3>Intelligence Artificielle</h3>
    </div>
  </div>
</div>
