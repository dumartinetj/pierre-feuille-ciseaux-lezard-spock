<h1 id="mainhead">Recherche d'un adversaire</h1>
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
<hr>
<div>

    <h2>Liste des joueurs en attente de partie:</h2>
    <p class="lead">
        <ul class="list-group">
        <?php
            if(estConnecte()){
                $joueur = Jeu::listeAttente();
                foreach($joueur as $j) {
                    $p = $j->pseudo;
                    $nb = $j->nbManche;
                    echo "<form method='post' action='jouer.php?action=rechercher'> <input type='hidden' name='nbManche' id='id_nbManche' value='".$nb.">";
                    echo "<li class='list-group-item'> <b>Pseudo:</b>".$p." <b>Nombre de Manches:</b> ".$nb." <button type='submit' class='btn btn-primary btn-lg'>Jouer!</button> </br> </li>";
                }
            }
        ?>
        </ul>
    </p>
</div>