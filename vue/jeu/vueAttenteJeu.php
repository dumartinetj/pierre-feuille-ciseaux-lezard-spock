<div class="col-md-3"></div>
<div class="col-md-6">
<h3>Vous êtes actuellement en attente d'un adversaire !</h3>
<h5>Cette page s'actualisera automatiquement toutes les 10 secondes...</h5>
<a href="jouer.php?action=annuler">Annuler votre recherche</a>
<form name="waiting" id="waiting" action="jouer.php?action=waiting" method="POST">
</form>
</div>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
          document.forms["waiting"].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 10000);
        }
    }
</script>
