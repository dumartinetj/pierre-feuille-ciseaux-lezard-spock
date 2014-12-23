  <div class="container">
    <div class='tabs-x tabs-above tab-align-center'>
      <ul id="onglets" class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#profil" role="tab" data-toggle="tab"><span class="fa fa-user"></span> Profil</a></li>
        <li><a href="#stats" role="tab-kv" data-toggle="tab"><span class="fa fa-bar-chart"></span> Statistiques de jeu</a></li>
        <li><a href="#historique" role="tab-kv" data-toggle="tab"><span class="fa fa-history"></span> Historique des parties</a></li>
      </ul>
      <div id="contenu" class="tab-content">
        <div class="tab-pane fade in active" id="profil">
          <div class="row">
            <div class="col-md-6">
              <h2><?php echo $_SESSION['pseudo']; ?></h2>
              <h3><i class="fa fa-<?php echo $s; ?>male"></i> | <?php echo $a; ?> ans</h3>
              <h3><i class="fa fa-envelope"></i> <?php echo $e; ?></h3>
              <hr>
              <h3>Classement - <?php echo $cl; ?><sup><?php echo $eme; ?></sup></h3>
              <div class="progress">
                <div class="progress-bar <?php echo $couleurpb; ?>" style="width: <?php echo $progressbar; ?>%;"></div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <p> <a href="joueur.php?action=update" class="btn btn-primary"><span class="fa fa-refresh"></span> Mettre à jour votre profil</a> </p>
                  <p> <a href="joueur.php?action=delete" class="btn btn-danger"><span class="fa fa-trash"></span> Supprimer votre profil</a> </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <h2>Ratio <?php echo $r ?></h2>
              <div id="ratio" style="height: 300px; width: 100%;"></div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="stats"><p>...</p></div>
        <div class="tab-pane fade" id="historique"><p>...</p></div>
      </div>
    </div>
  </div>
        <script type="text/javascript">
        var nbv = <?php echo $nbv ?>;
        var nbd = <?php echo $nbd ?>;
        if(nbv+nbd==0) {
          document.getElementById("ratio").innerHTML = "Aucune données de jeu n'est disponible !";
        }
        else {
          window.onload = function () {
            var chart = new CanvasJS.Chart("ratio",
            {
              backgroundColor: "#eeeeee",
              legend: {
                horizontalAlign: "center", // "center" , "right"
                verticalAlign: "bottom",  // "top" , "bottom"
                fontFamily: "Asap"
              },
              data: [
              {
                type: "doughnut",
                showInLegend: true,
                startAngle:0,
                indexLabelFontSize: 25,
                indexLabelFontFamily: "Asap",
                indexLabelFontColor: "#eeeeee",
                indexLabelLineColor: "#eeeeee",
                indexLabelPlacement: "outside",
                indexLabelLineThickness: 0,
                toolTipContent: "{y} {label} - <strong>#percent%</strong>",
                indexLabel: "",
                dataPoints: [
                {  y: nbv, legendText:"Victoire(s)", label: "victoire(s)" },
                {  y: nbd, legendText:"Défaite(s)", label: "défaite(s)" }
                ]
              }
              ]
            });
            chart.render();
          }
        }
        </script>
