<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <title >PFCLS - <?php if (isset($pagetitle)) echo "$pagetitle"; else echo "Erreur" ?></title>
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
                <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="jouer.php">Jouer !</a></li>
                    <li><a href="index.php?action=regles">Règle du jeu</a></li>
                    <li><a href="#">Statistiques</a></li>
					<li><a href="joueur.php?action=search">Rechercher un joueur</a></li>
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
                <?php if(!isset($vue)) echo "<h3>$messageErreur</h3>";
                  else require VIEW_PATH.$page.DS.'vue'.ucfirst($vue).ucfirst($page).'.php';?>
            </div>
        </div>
        </div>
        <!-- Fin principal -->
        <!-- Footer -->
        <div id="push"></div>
        </div>
        <div id="footer">
            <div class="container">
                <p class="credit">Copyright © 2014 todo</p>
            </div>
        </div>
        <!-- JS placé à la fin pour un chargement plus rapide -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="<?= VIEW_PATH_BASE; ?>js/bootstrap.min.js"></script>
        <script src="<?= VIEW_PATH_BASE; ?>js/jquery.smartmenus.bootstrap.min.js"></script>
        <script src="<?= VIEW_PATH_BASE; ?>js/jquery.smartmenus.min.js"></script>
    </body >
</html >
