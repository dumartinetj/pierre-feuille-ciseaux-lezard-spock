<?php
echo <<< EOT
<h1>$nomF1 VS $nomF2</h1>
<h1>$message</h1>
EOT;
?>
<h5>Cette page s'actualisera automatiquement dans 5 secondes...</h5>
<form name="jouer" id="jouer" action="jouer.php?action=jouer" method="POST">
</form>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
          document.forms["jouer"].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 5000);
        }
    }
</script>
