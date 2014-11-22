<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <title>PFCLS - <?php if (isset($pagetitle)) echo "$pagetitle"; else echo "Erreur" ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?= VIEW_PATH_BASE; ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= VIEW_PATH_BASE; ?>css/style.css" rel="stylesheet">
        <link href="<?= VIEW_PATH_BASE; ?>css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <!-- Menu -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="<?= VIEW_PATH_BASE; ?>img/logo.png" alt=""></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li <?php if (isset($vue)) if (($page=="index" && $vue=="choixMode") || $page=="jeu" || $page=="jeuIA") echo 'class="active"'; ?>><a href="index.php?action=choixmode">Jouer !</a></li>
                    <li <?php if (isset($vue)) if ($page=="index" && $vue=="regles") echo 'class="active"'; ?>><a href="index.php?action=regles">Règles du jeu</a></li>
                    <?php if(estConnecte()) include_once VIEW_PATH.'menu'.DS.'vueMenuConnecte.php';
                    else include_once  VIEW_PATH.'menu'.DS.'vueMenuNonConnecte.php';
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container -->
        </div>
        <!-- Fin du menu -->
        <div id="wrap">
        <div class="container">
        <!-- Principal -->
        <div class="row" id="main-content">
            <div class="col-md-1"></div>
            <div class="col-md-12">
              <div class="container">
                <div class="jumbotron">
                <?php if(!isset($vue)) {
                    echo "<h2>$messageErreur</h2>";
                    echo '<img class="img-responsive center-block" src="'.VIEW_PATH_BASE.'img/glitch.png" alt="Heeee ?!">';
                  }
                  else require VIEW_PATH.$page.DS.'vue'.ucfirst($vue).ucfirst($page).'.php';?>
                </div>
              </div>
            </div>
        </div>
        </div>
        <!-- Fin principal -->
        <!-- Footer -->
        <div id="push"></div>
        </div>
        <div id="footer">
            <div class="container">
                <p class="credit">Copyright © 2014 - <a href="index.php?action=apropos">À propos</a></p>
            </div>
        </div>
        <!-- JS placé à la fin pour un chargement plus rapide -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="<?= VIEW_PATH_BASE; ?>js/bootstrap.min.js"></script>
        <script src="<?= VIEW_PATH_BASE; ?>js/jquery.smartmenus.bootstrap.min.js"></script>
        <script src="<?= VIEW_PATH_BASE; ?>js/jquery.smartmenus.min.js"></script>
    </body >
</html >
