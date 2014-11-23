<?php
  function vueListeAttente($listeJoueurs) {
    if($listeJoueurs == null) echo "Aucun utilisateur n'est en attente d'un adversaire !";
    else {
      foreach($listeJoueurs as $joueur) {
        $p = $joueur->pseudo;
        $nb = $joueur->nbManche;
        switch ($nb) {
          case "1":
            $couleur = "info";
          break;
          case "3":
            $couleur = "success";
          break;
          case "5":
            $couleur = "primary";
          break;
          case "7":
            $couleur = "warning";
          break;
          case "9":
            $couleur = "danger";
          break;
        }
        echo '<form method="post" action="jouer.php?action=rechercher">
        <input type="hidden" name="nbManche" id="id_nbManche" value='.$nb.'>
        <button class="btn btn-default btn-sm disabled"><span class="glyphicon glyphicon-user"></span> '.$p.'</button>
        <button class="btn btn-'.$couleur.' btn-sm disabled">'.$nb.'</button>
        <input type="submit" class="btn btn-primary btn-sm" value="Jouer"/>
        </form><br/>';
      }
    }
}
?>

<h1 id="mainhead">Recherche d'un adversaire</h1>
<hr>
  <h2>Liste des joueurs en attente d'un adversaire :</h2>
    <div class="center-block">
    <?php vueListeAttente($listeJoueurs); ?>
    </div>
<hr>
<p>Choisissez le nombre de manches que vous voulez jouer !<br/>
Pour connaître les règles du jeu et le déroulement d'une partie, rendez-vous sur la <a href="index.php?action=regles">page des règles du jeu</a></p>

<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-2">
    <form method="post" action="jouer.php?action=rechercher">
      <input type="hidden" name="nbManche" id="id_nbManche" value="1">
      <button type="submit" class="btn btn-info btn-lg">1</button>
    </form>
  </div>
  <div class="col-md-1">
  </div>
  <div class="col-md-2">
    <form method="post" action="jouer.php?action=rechercher">
      <input type="hidden" name="nbManche" id="id_nbManche" value="3">
      <button type="submit" class="btn btn-success btn-lg">3</button>
    </form>
  </div>
  <div class="col-md-1">
  </div>
  <div class="col-md-2">
    <form method="post" action="jouer.php?action=rechercher">
      <input type="hidden" name="nbManche" id="id_nbManche" value="5">
      <button type="submit" class="btn btn-primary btn-lg">5</button>
    </form>
  </div>
  <div class="col-md-1">
  </div>
  <div class="col-md-2">
    <form method="post" action="jouer.php?action=rechercher">
      <input type="hidden" name="nbManche" id="id_nbManche" value="7">
      <button type="submit" class="btn btn-warning btn-lg">7</button>
    </form>
  </div>
  <div class="col-md-1">
  </div>
  <div class="col-md-2">
    <form method="post" action="jouer.php?action=rechercher">
      <input type="hidden" name="nbManche" id="id_nbManche" value="9">
      <button type="submit" class="btn btn-danger btn-lg">9</button>
    </form>
  </div>
</div>
