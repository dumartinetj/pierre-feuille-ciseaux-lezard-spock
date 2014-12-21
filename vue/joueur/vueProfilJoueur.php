  <div class="container">
    <ul class="nav nav-pills">
      <li class="active"><a href="#profil" data-toggle="tab"><span class="fa fa-user"></span></span> Informations personnelles</a></li>
      <li><a href="#stats" data-toggle="tab"><span class="fa fa-bar-chart"></span> Statistiques de jeu</a></li>
      <li><a href="#historique" data-toggle="tab"><span class="fa fa-history"></span> Historique des parties</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="profil">
        <p></p>
        <div class="row">
          <div class="col-md-6">
        <p>
<?php
echo <<< EOT
Pseudo : $p <br/>
Age : $a <br/>
Sexe : $s <br/>
E-mail : $e <br/>
EOT;
?>
        </p>

        <div class="row">
          <div class="col-md-12">
            <p> <a href="joueur.php?action=update" class="btn btn-primary"><span class="fa fa-refresh fa-spin"></span> Mettre à jour votre profil</a> </p>
            <p> <a href="joueur.php?action=delete" class="btn btn-danger"><span class="fa fa-trash"></span> Supprimer votre profil</a> </p>
          </div>
        </div>
      </div>
        <div class="col-md-6">
          <h2>Ratio <?php echo $r ?></h2>
          <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="stats">
      <p></p>
    </div>
    <div class="tab-pane" id="historique">
      <p></p>
    </div>
    </div>
        </div>
        <script type="text/javascript">
        window.onload = function () {
          var chart = new CanvasJS.Chart("chartContainer",
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
              {  y: <?php echo $nbv ?>, legendText:"Victoire(s)", label: "victoire(s)" },
              {  y: <?php echo $nbd ?>, legendText:"Défaite(s)", label: "défaite(s)" }
              ]
            }
            ]
          });
          chart.render();
        }
        </script>
