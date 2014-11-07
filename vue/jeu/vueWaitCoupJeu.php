<h3>Vous attendez actuellement que votre adversaire joue son coup !</h3>
<h5>Cette page s'actualisera automatiquement toutes les 5 secondes...</h5>
<form name="waitingCoup" id="waitingCoup" action="jouer.php?action=waitingCoup" method="POST">
<input type="hidden" name="idFigure" id="idFigure"  value="<?= $idFigure; ?>">
</form>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
          document.forms["waitingCoup"].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 5000);
        }
    }
</script>
