<h1>Vous avez joué deux figures identifiques ! Vous allez devoir rejouez le coup !</h1>
<h5>Cette page s'actualisera automatiquement dans 3 secondes...</h5>
<form name="rejouerCoup" id="rejouerCoup" action="jouer.php?action=rejouerCoup" method="POST">
</form>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
          document.forms["rejouerCoup"].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 3000);
        }
    }
</script>
