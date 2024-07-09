<!DOCTYPE html>
<html>
<head>
    <title>Device Data Chart</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        var rawData = @json($chartData);

        // Convert raw data into a format Google Charts can understand
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date'); // Use 'string' for a better time series display
        data.addColumn('number', 'Soil Temperature');
        data.addColumn('number', 'Soil Humidity');
        data.addColumn('number', 'Air Temperature');
        data.addColumn('number', 'Air Humidity');

        for (var i = 0; i < rawData.length; i++) {
          var row = rawData[i];
          data.addRow([
            row.date,
            parseFloat(row.S_TEMP),
            parseFloat(row.S_HUM),
            parseFloat(row.A_TEMP),
            parseFloat(row.A_HUM)
          ]);
        }

        var options = {
          title: 'Sensor Readings Over Time',
          vAxis: {title: 'Values'},
          hAxis: {title: 'Date/Time'},
          seriesType: 'bars',
          series: {1: {type: 'line'}} // Change series index if necessary
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>
    <div id="chart_div" style="width: 1000px; height: 600px;"></div>
</body>
</html>
