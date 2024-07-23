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

        <div class="grid grid-cols-4 gap-4 border-2 border-blue-200 border-collapse px-10 py-10 rounded">
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
        <div class="grid grid-cols-3  ">
            <div class=" border-none">
                <div class=" h-60 w-60">
                    <p class=" font-serif font-semibold text-2xl ml-18 mt-4">Users categories</p>
                    <canvas id="chart-pie"></canvas>
                </div>
            </div>

        </div>

        <div class="flex gap-14 mt-20">
            <div class="w-1/2 ">
                <p class="text-2xl font-serif font-semibold text-blue-800 mb-2"> Graphical Representation</p>
                <div id="chart_div" style="width: 100%; height: 600px;"></div> <br>
                <div class="p-7 bg-black text-white rounded  cursor-pointer">
                    <h2 class="font-serif font-bold text-2xl text-gray-200 text-center mb-3 underline">Weather in
                        {{ $weatherData['name'] }}</h2>
                    <table>
                        <th>
                            <tr class="border border-spacing-2">
                                <th class="border text-xl px-4 py-2">Temperature</th>
                                <th class="border text-xl px-4 py-2">Humidity</th>
                                <th class="border text-xl px-4 py-2">Condition</th>
                            </tr>
                        </th>
                        <tr>
                            <td class="border">
                                <p class="font-serif text-xl font-semibold text-center ">
                                    {{ $weatherData['main']['temp'] - 273.15 }} °C</p>
                            </td>
                            <td class="border">
                                <p class="font-serif text-xl font-semibold text-center ">
                                    {{ $weatherData['main']['humidity'] }}%</p>
                            </td>
                            <td class="border">
                                <p class="font-serif text-xl font-semibold text-center ">
                                    {{ $weatherData['weather'][0]['description'] }}</p>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
            <div class="w-1/2">

                <div class="ml-30">
                    <p class="text-2xl font-serif font-semibold text-blue-800"> Activated Users</p>
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
                <canvas id="chart-line"></canvas>
            </div>
        </div>
    </main>

    @include('layouts.footer')

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            var ctx = document.getElementById('chart-pie').getContext('2d');
            var femaleCount = {{ $femaleCount }};
            var maleCount = {{ $maleCount }};
            var totalCount = {{ $totalCount }};
            var dataPie = {
                type: "pie",
                data: {
                    labels: ["Female(" + femaleCount + "/" + totalCount + ")", "Male(" + maleCount + "/" +
                        totalCount + ")"
                    ],
                    datasets: [{
                        data: [femaleCount, maleCount],
                        backgroundColor: [
                            "rgba(29, 78, 216)",
                            "rgba(4, 120, 87)",
                        ],
                    }],
                },

            };

            new Chart(ctx, dataPie);

        });

        var ctxLine = document.getElementById('chart-line').getContext('2d');
        var tempearture = {{ $weatherData['main']['temp'] - 273.15 }};
        var humidity = {{ $weatherData['main']['humidity'] }};
        var dataLine = {
            type: "line",
            data: {
                labels: ["Weather State"],
                datasets: [{
                    label: "Weather condition",
                    data: [tempearture, humidity],
                    borderColor: "rgba(255, 255, 255, 1)",
                    backgroundColor: "rgba(0, 0, 0, 0.5)",
                    fill: false,
                }],
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Days'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Traffic'
                        }
                    }
                }
            }
        };
        new Chart(ctxLine, dataLine);
    </script>
@endsection
