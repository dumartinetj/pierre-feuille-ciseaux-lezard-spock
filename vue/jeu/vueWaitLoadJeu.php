<img class="img-responsive center-block" src="<?= VIEW_PATH_BASE.'jeu/img/load.gif'?>">
<h1 id="mainhead">Préparation des données, veuillez patienter...</h1>
<h5>Cette page s'actualisera automatiquement dans 5 secondes...</h5>
<form name="waitingLoad" id="waitingLoad" action="jouer.php?action=waitingLoad" method="POST">
</form>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
          document.forms["waitingLoad"].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 5000);
        }
    }
</script>
