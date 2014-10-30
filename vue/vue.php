<! DOCTYPE html >
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle ; ?></title>
    </head>
    <body>
        <nav>
            <ul>
                <li>
                <a href="index.php">Accueil. </a>
                </li><li>
                <a href="joueur.php">Joueurs. </a>
                </li>
            </ul>
        </nav>
        <?php
            require VIEW_PATH.$page.DS.'vue'.ucfirst($vue).ucfirst($page).'.php';
	?>
    </body >
</html >