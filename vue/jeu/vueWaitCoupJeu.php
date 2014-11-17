<img class="img-responsive center-block" src="<?= VIEW_PATH_BASE.'jeu/img/load.gif'?>">
<h1 id="mainhead">Vous attendez actuellement que votre adversaire joue son coup !</h1>
<?php if ($temps_attente>20) echo '<h4><a href="jouer.php?action=annulerPartie">Temps d\'attente trop long ? Annuler la partie !</a></h4>'; ?>
<h5>Cette page s'actualisera automatiquement toutes les 3 secondes...</h5>
<form name="waitingCoup" id="waitingCoup" action="jouer.php?action=waitingCoup" method="POST">
   <input type="hidden" name="temps_attente" id="temps_attente" value="<?= $temps_attente+3; ?>">
</form>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
          document.forms["waitingCoup"].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 3000);
        }
    }
</script>
