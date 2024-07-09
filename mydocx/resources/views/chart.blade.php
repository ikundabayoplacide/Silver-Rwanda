{{-- <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
        //   ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>
</html> --}}


{{--
<!DOCTYPE html>
<html>
<head>
    <title>Device Data Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="deviceDataChart" width="400" height="200"></canvas>
    <script>
        var ctx = document.getElementById('deviceDataChart').getContext('2d');
        var deviceDataChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    @foreach($aggregatedData as $data)
                        "{{ $data->date }}",
                    @endforeach
                ],
                datasets: [
                    {
                        label: 'Average Soil Humidity',
                        data: [
                            @foreach($aggregatedData as $data)
                                {{ $data->avg_s_hum }},
                            @endforeach
                        ],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: 'Average Soil Temperature',
                        data: [
                            @foreach($aggregatedData as $data)
                                {{ $data->avg_s_temp }},
                            @endforeach
                        ],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: 'Average Air Temperature',
                        data: [
                            @foreach($aggregatedData as $data)
                                {{ $data->avg_a_temp }},
                            @endforeach
                        ],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: 'Average Air Humidity',
                        data: [
                            @foreach($aggregatedData as $data)
                                {{ $data->avg_a_hum }},
                            @endforeach
                        ],
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        fill: false
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
 --}}

 

 <!DOCTYPE html>
 <html>
 <head>
     <title>Device Data Chart</title>
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
 </html>
