@extends('layouts.layout')

@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')
    @include('layouts.aside')
    @include('layouts.graphData')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-4 gap-4 border-2 border-blue-500 border-collapse px-10 py-10 rounded">
            <div class="p-7 bg-blue-500 text-white rounded hover:bg-blue-700 cursor-pointer">
                <p class="font-serif font-bold text-2xl text-gray-200 text-center mb-3">{{ Auth::user()->count() }}</p>
                <p class="font-serif text-2xl font-semibold text-center">Users</p>
            </div>
            <div class="p-7 bg-green-500 text-white rounded hover:bg-green-700 cursor-pointer">
                <p class="font-serif font-bold text-2xl text-gray-200 text-center mb-3">{{ $farmerCount }}</p>
                <p class="font-serif text-2xl font-semibold text-center">Farmers</p>
            </div>
            <div class="p-7 bg-yellow-500 text-white rounded hover:bg-yellow-700 cursor-pointer">
                <p class="font-serif font-bold text-2xl text-gray-200 text-center mb-3">{{ $cooperativeCount }}</p>
                <p class="font-serif text-2xl font-semibold text-center">Cooperatives</p>
            </div>
            <div class="p-7 bg-red-500 text-white rounded hover:bg-red-700 cursor-pointer">
                <p class="font-serif font-bold text-2xl text-gray-200 text-center mb-3">{{ $deviceCount }}</p>
                <p class="font-serif text-2xl font-semibold text-center">Devices</p>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-3 border-2 border-green-500 rounded pb-10 mt-3">
            <div class="border-none">
                <div class="h-60 w-60 ml-5">
                    <p class="font-serif font-semibold text-2xl ml-15 mt-4">Users categories</p>
                    <canvas id="chart-pie"></canvas>
                </div>
            </div>
            <div class="border-none">
                <div class="h-60 w-60 ml-5">
                    <p class="font-serif font-semibold text-2xl ml-15 mt-4">Farmers categories</p>
                    <canvas id="chart-pieFarmer"></canvas>
                </div>
            </div>
            <div class="border-none">
                <div class="h-60 w-60 ml-5">
                    <p class="font-serif font-semibold text-2xl ml-15 mt-4">Device categories</p>
                    <canvas id="chart-pieDevice"></canvas>
                 
                </div>
            </div>
        </div>
        <div class="mt-4">
            <p class="text-2xl font-serif font-semibold text-blue-800 mb-2 text-center">Graphical Representation</p>
            <div class="card-body">
                <h5 class="card-title">Device <span>/Data Generations</span></h5>
                <div id="reportsChart"></div>
            </div>
        </div>
        <div class="flex gap-14 mt-20">
            <div class="w-1/2">
                <p class="text-2xl font-serif font-semibold text-blue-800 mb-2">Graphical Representation</p>
                <div id="chart_div" style="width: 100%; height: 600px;"></div><br>
            </div>
            <div class="w-1/2">
                <div class="ml-30">
                  <p class="text-2xl font-serif font-semibold text-blue-700 mb-2"> Current Climate Data</p>
                  <div class="p-7 bg-blue-800 text-white rounded cursor-pointer">
                    <h2 class="font-serif font-semibold text-2xl text-center mb-3 ">Weather in
                        {{ $weatherData['name'] }}</h2>
                    <table>
                        <thead>
                            <tr class="border-2 border-spacing-2 p-5">
                                <th class="border-2 font-semibold text-xl px-4 py-3">Temperature</th>
                                <th class="border-2 font-semibold text-xl px-4 py-3">Humidity</th>
                                <th class="border-2 font-semibold text-xl px-4 py-3">Condition</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-2">
                                    <p class="font-serif text-xl font-semibold text-center py-3">
                                        {{ $weatherData['main']['temp'] - 273.15 }} °C</p>
                                </td>
                                <td class="border-2">
                                    <p class="font-serif text-xl font-semibold text-center py-3">
                                        {{ $weatherData['main']['humidity'] }}%</p>
                                </td>
                                <td class="border-2">
                                    <p class="font-serif text-xl font-semibold text-center py-3">
                                        {{ $weatherData['weather'][0]['description'] }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    <p class="text-2xl font-serif font-semibold text-blue-800 mt-6">Activated Users</p>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Mobile</th>
                                <th>Payed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <p>$220</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </main>

    @include('layouts.footer')

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {
            // Pie Chart
            var ctx = document.getElementById('chart-pie').getContext('2d');
            var femaleCount = {{ $femaleCount }};
            var maleCount = {{ $maleCount }};
            var totalCount = {{ $totalCount }};
            var dataPie = {
                type: 'pie',
                data: {
                    labels: ["Female (" + femaleCount + "/" + totalCount + ")", "Male (" + maleCount + "/" +
                        totalCount + ")"
                    ],
                    datasets: [{
                        data: [femaleCount, maleCount],
                        backgroundColor: ["rgba(6, 182, 212, 1)", "rgba(4, 120, 87)",],
                    }],
                },
            };
            new Chart(ctx, dataPie);

            // script for farmer

            $(document).ready(function() {
            var ctxFarmers = document.getElementById('chart-pieFarmer').getContext('2d');
            var femaleFarmer = {{ $femaleFarmersCount }};
            var maleFarmer = {{ $maleFarmersCount }};
            var totalFarmerCount = {{ $totalFarmerCount }};
            var dataPieFarmer = {
                type: "pie",
                data: {
                    labels: ["Female(" + femaleFarmer + "/" + totalFarmerCount + ")","Male(" + maleFarmer + "/" +
                    totalFarmerCount + ")"
                    ],
                    datasets: [{
                        data: [femaleFarmer, maleFarmer],
                        backgroundColor: [
                            "rgba(255, 193, 7, 1)",
                            "rgba(244, 67, 54, 1)",
                        ],
                    }],
                },
            };
            new Chart(ctxFarmers, dataPieFarmer);
        });

        $(document).ready(function() {
            var ctxDevice = document.getElementById('chart-pieDevice').getContext('2d');
            var FunctionDevice = {{ $functionCount }};
            var nonFunctionDevice = {{ $nonFunctionCount }};
            var InStock = {{ $InStock }};
            var TotalDevice = {{ $totalDeviceCount }};
            var dataPieDevice = {
                type: "pie",
                data: {
                    labels: ["Functional Device(" + FunctionDevice + "/" + TotalDevice + ")","NonFunctional Device(" + nonFunctionDevice + "/" +
                    TotalDevice + ")","Device In Stock("+InStock+"/"+TotalDevice+")"
                    ],
                    datasets: [{
                        data: [FunctionDevice, nonFunctionDevice,InStock],
                        backgroundColor: [
                            " rgba(4, 120, 87)",
                            "rgba(255, 193, 7, 1)",
                            "rgba(244, 67, 54, 1)",
                        ],
                    }],
                },
            };
            new Chart(ctxDevice, dataPieDevice);
        });

            // Line Chart
            var options = {
                series: [{
                    name: 'Soil Temperature',
                    data: [31, 40, 28, 51, 42, 82, 56],
                }, {
                    name: 'Soil Humidity',
                    data: [11, 32, 45, 32, 34, 52, 41]
                }, {
                    name: 'Air Temperature',
                    data: [35, 11, 32, 18, 9, 24, 11]
                }, {
                    name: 'Air Humidity',
                    data: [45, 11, 12, 8, 9, 24, 21]
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                markers: {
                    size: 4
                },
                colors: ['#4154f1', '#2eca6a', '#ffc107', '#B91C1C'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },

                xaxis: {
                    type: 'datetime',
                    categories: ["2024-07-23T00:00:00.000Z", "2024-07-23T01:30:00.000Z",
                        "2024-07-23T02:30:00.000Z", "2024-07-23T03:30:00.000Z", "2024-07-23T04:30:00.000Z",
                        "2024-07-23T05:30:00.000Z", "2024-07-23T06:30:00.000Z"
                    ]
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                }
            };
            var chart = new ApexCharts(document.querySelector("#reportsChart"), options);
            chart.render();
        });
    </script>
    <!-- End Line Chart -->
@endsection
