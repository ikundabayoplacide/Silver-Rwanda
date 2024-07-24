{{--
 <!DOCTYPE html>
 <html>
 <head>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
       google.charts.load('current', {packages: ['corechart', 'line']});
       google.charts.setOnLoadCallback(drawChart);

       function drawChart() {
         var rawData = {!! $chartData !!};

         // Convert date strings to Date objects and prepare data array for Google Charts
         var data = new google.visualization.DataTable();
         data.addColumn('date', 'Date');
         data.addColumn('number', 'Avg Soil Humidity');
         data.addColumn('number', 'Avg Soil Temperature');
         data.addColumn('number', 'Avg Air Temperature');
         data.addColumn('number', 'Avg Air Humidity');

         for (var i = 1; i < rawData.length; i++) {
           var row = rawData[i];
           data.addRow([
             new Date(row.date),
             parseFloat(row.avg_s_hum),
             parseFloat(row.avg_s_temp),
             parseFloat(row.avg_a_temp),
             parseFloat(row.avg_a_hum)
           ]);
         }

         var options = {
           title: 'Average Sensor Readings Over Time',
           curveType: 'function',
           legend: { position: 'bottom' },
           hAxis: {
             title: 'Date'
           },
           vAxis: {
             title: 'Values'
           }
         };

         var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

         chart.draw(data, options);
       }
     </script>
 </head>
 <body>
     <div id="curve_chart" style="width: 1500px; height: 800px"></div>
 </body>
 </html> --}}
