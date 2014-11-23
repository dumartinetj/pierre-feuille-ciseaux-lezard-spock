<h1 id="mainhead">Recherche d'un adversaire</h1>
<hr>
<p>Choisissez le nombre de manches que vous voulez jouer contre l'IA !<br/>
  Pour connaître les règles du jeu et le déroulement d'une partie, rendez-vous sur la <a href="index.php?action=regles">page des règles du jeu</a></p>

  <div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-2">
      <form method="post" action="jouerIA.php?action=begin">
        <input type="hidden" name="nbManche" id="id_nbManche" value="1">
        <button type="submit" class="btn btn-info btn-lg">1</button>
      </form>
    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-2">
      <form method="post" action="jouerIA.php?action=begin">
        <input type="hidden" name="nbManche" id="id_nbManche" value="3">
        <button type="submit" class="btn btn-success btn-lg">3</button>
      </form>
    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-2">
      <form method="post" action="jouerIA.php?action=begin">
        <input type="hidden" name="nbManche" id="id_nbManche" value="5">
        <button type="submit" class="btn btn-primary btn-lg">5</button>
      </form>
    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-2">
      <form method="post" action="jouerIA.php?action=begin">
        <input type="hidden" name="nbManche" id="id_nbManche" value="7">
        <button type="submit" class="btn btn-warning btn-lg">7</button>
      </form>
    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-2">
      <form method="post" action="jouerIA.php?action=begin">
        <input type="hidden" name="nbManche" id="id_nbManche" value="9">
        <button type="submit" class="btn btn-danger btn-lg">9</button>
      </form>
    </div>
  </div>
