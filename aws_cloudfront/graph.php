<?php
include("c.php");
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        <?=GoogleGraphStr();?>
        ]);

        var options = {
          title: 'AWS CloudFront Usage according to what will be billed'
        };

        var chart = new google.visualization.<?=$graph;?>Chart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 900px;"></div>
  </body>
</html>
