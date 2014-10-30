<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
				<meta charset="UTF-8">
				<title >PFCLS - <?php echo $pagetitle; ?></title>
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link href="<?= VIEW_PATH_BASE; ?>css/bootstrap.min.css" rel="stylesheet">
				<link href="<?= VIEW_PATH_BASE; ?>css/style.css" rel="stylesheet">
	</head>
	<body>
		<div id="wrap">
			<!-- Header -->
			<div class="container-fluid">
				<header class="row">
					<div class="col-md-2">
						<img src="<?= VIEW_PATH_BASE; ?>img/logo.png" width="120" class="img-thumbnail">
					</div>
					<div class="col-md-10">
							<div class="row">
								<div class="col-md-10">
									<h1 align="center"><small>Pierre Feuille Ciseaux Lézard Spock</small></h1>
								</div>
								<div class="col-md-2"></div>
							</div>
				</div>
				</header>
			</div>
			<!-- Fin header -->
			<div class="container">
				<!-- Menu -->
				<nav role="navigation" class="navbar navbar-default">
					<div class="container">
						<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="collapse navbar-collapse navHeaderCollapse">
							<ul class="nav navbar-nav">
								<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
								<li><a href="joueur.php"><span class="glyphicon glyphicon-refresh"></span> Joueur</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-calendar"></span> Menu 3</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-cloud-download"></span> Menu 4</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Menu 5</a></li>
							</ul>
						</div>
					</div>
    		</nav>
				<!-- Fin du menu -->
				<!-- Principal -->
				<div class="row" id="main-content">
					<div class="col-md-1"></div>
					<div class="col-md-12">
				<?php
				require VIEW_PATH.$page.DS.'vue'.ucfirst($vue).ucfirst($page).'.php';
				?>
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
	</body >
</html >
