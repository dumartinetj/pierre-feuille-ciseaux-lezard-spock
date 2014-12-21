<li <?php if (isset($vue)) if ($page=="joueur" && ($vue=="creation" || $vue=="created")) echo 'class="active"'; ?>><a href="joueur.php?action=inscription"><span class="fa fa-coffee"></span> S'inscrire</a>
<li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown"><span class="fa fa-toggle-on"></span> Se connecter</a>
  <div class="dropdown-menu" style="padding: 15px;">
    <form method="post" action="joueur.php?action=connect">
      <input type="text" id="id_pseudo" class="form-control" name="pseudo" placeholder="Pseudo" required/><br/>
      <input type="password" id="id_pwd" class="form-control" name="pwd" placeholder="Mot de passe" required/><br/>
      <input type="hidden" name="redirurl" value="<?php if(isset($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER']; ?>" />
      <input type="submit" class="btn btn-default" name="submit" value="&#xf205; Connexion"/><br/><br/>
    </form>
  </div>
</li>

  <script type="text/javascript"> // évite que les input sortent du form s'ils sont trop grand
  $(function() {
    $('.dropdown-toggle').dropdown();
    $('.dropdown input').click(function(e) {
      e.stopPropagation();
    });
  });
  </script>
