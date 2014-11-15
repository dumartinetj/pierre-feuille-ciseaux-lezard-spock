<div class="row">
          <div class="col-md-4">
          <div class="thumbnail">
            <img src="<?= VIEW_PATH_BASE.'jeu/img/'.$idF1.'.png'?>">
          </div>
          </div>
          <div class="col-md-4">
          <div class="thumbnail">
            <img src="<?= VIEW_PATH_BASE.'jeu/img/versus.png'?>">
          </div>
          </div>
          <div class="col-md-4">
          <div class="thumbnail">
            <img src="<?= VIEW_PATH_BASE.'jeu/img/'.$idF2.'.png'?>">
          </div>
          </div>
</div>
<h1 id="mainhead"><?= $message ?></h1>
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
