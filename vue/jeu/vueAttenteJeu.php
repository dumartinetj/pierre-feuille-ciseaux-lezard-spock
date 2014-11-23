<img class="img-responsive center-block" src="<?= VIEW_PATH_BASE.'jeu/img/load.gif'?>">
<h1 id="mainhead">Vous êtes actuellement en attente d'un adversaire !</h1>
<h5>Cette page s'actualisera automatiquement toutes les 5 secondes...</h5>
<a href="<?php $_SERVER['PHP_SELF']; ?>?action=annuler">Annuler votre recherche d'adversaire</a>
<form name="waiting" id="waiting" action="<?php $_SERVER['PHP_SELF']; ?>?action=waiting" method="POST">
</form>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
          document.forms["waiting"].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 5000);
        }
    }
</script>
