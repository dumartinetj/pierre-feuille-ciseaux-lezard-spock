<?php
echo <<< EOT
<h1>$nomF1 VS $nomF2</h1>
<h1>$message</h1>
EOT;
?>
<h5>Cette page s'actualisera automatiquement dans 5 secondes...</h5>
<form name="" id="" action="jouer.php?action=" method="POST">
</form>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
          document.forms[""].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 5000);
        }
    }
</script>
