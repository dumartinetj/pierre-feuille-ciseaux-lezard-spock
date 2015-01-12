    <h2 id="mainhead"><span class="fa fa-pie-chart"></span> Statistiques</h2>
    <hr>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div id="premiereFigure" style="height: 400px; width: 100%;"></div>
      </div>
    </div>

    <script type="text/javascript">
    window.onload = function () {
      var compte = <?php echo $compte ?>;
      if(compte==0) {
        document.getElementById("premiereFigure").innerHTML = "Aucune données de jeu n'est disponible !";
      }
      else {
        var f1 = <?php echo $premierCoup['1']*100/$compte ?>;
        var f2 = <?php echo $premierCoup['2']*100/$compte ?>;
        var f3 = <?php echo $premierCoup['3']*100/$compte ?>;
        var f4 = <?php echo $premierCoup['4']*100/$compte ?>;
        var f5 = <?php echo $premierCoup['5']*100/$compte ?>;
        var chartPremierCoup = new CanvasJS.Chart("premiereFigure",
        {
          backgroundColor: "#eeeeee",
          legend: {
            horizontalAlign: "center", // "center" , "right"
            verticalAlign: "bottom",  // "top" , "bottom"
            fontFamily: "Asap"
          },
          title:{
            text: "Première figure jouée"
          },
          axisY: {
            title: "Pourcentage"
          },
          data: [
          {
            type: "column",
            showInLegend: false,
            indexLabelFontSize: 25,
            indexLabelFontFamily: "Asap",
            indexLabelFontColor: "#eeeeee",
            indexLabelLineColor: "#eeeeee",
            indexLabelPlacement: "outside",
            //indexLabelLineThickness: 0,
            toolTipContent: "{y}% de {label}",
            valueFormatString: "0.00",
            indexLabel: "",
            dataPoints: [
            {y: f1, label: "Pierre" },
            {y: f2,  label: "Feuille" },
            {y: f3,  label: "Ciseaux" },
            {y: f4,  label: "Lézard" },
            {y: f5,  label: "Spock" },
            ]
          }
          ]
        });
        chartPremierCoup.render();
        chartPremierCoup = {};
      }
    }
  </script>
