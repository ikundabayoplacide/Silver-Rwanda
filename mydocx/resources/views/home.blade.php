<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Laravel Highcharts Demo</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>

<body>
    <h1>Highcharts in Laravel Example</h1>
    <div id="container"></div>

    <script type="text/javascript">
        var userData = @json($formattedData);

        Highcharts.chart('container', {
            title: {
                text: 'New User Growth, {{ date("Y") }}'
            },
            xAxis: {
                categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ]
            },
            yAxis: {
                title: {
                    text: 'Number of New Users'
                }
            },
            series: [{
                name: 'New Users',
                data: userData
            }]
        });
    </script>
</body>

</html>
