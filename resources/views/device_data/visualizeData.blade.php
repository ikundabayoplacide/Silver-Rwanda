@extends('layouts.layout')
@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')

    @include('layouts.aside')


    <main id="main" class="main">
        <p class="text-2xl font-serif font-semibold text-center">{{ __('Visualization of Data') }}</p>
        <div class="mb-4 flex space-x-4">
            <a href="{{ route('device_data.display', ['download' => 'pdf']) }}" class="btn btn-danger flex items-center space-x-2">
                <i class="fas fa-file-pdf"></i>
                <span>PDF</span>
            </a>
            <a href="{{ route('device_data.display', ['download' => 'excel']) }}" class="btn btn-success flex items-center space-x-2">
                <i class="fas fa-file-excel"></i>
                <span>Excel</span>
            </a>
            <a href="{{ route('device_data.display', ['download' => 'csv']) }}" class="btn btn-info flex items-center space-x-2">
                <i class="fas fa-file-csv"></i>
                <span>CSV</span>
            </a>
            <button id="copy-csv" class="btn btn-gray">
                <i class="fa fa-copy"></i> Copy
            </button>
        </div>

        <script>
            document.getElementById('copy-csv').addEventListener('click', function() {
                fetch('{{ route('device_data.display', ['download' => 'csv']) }}')
                    .then(response => response.text())
                    .then(data => {
                        // Create a temporary textarea element to hold the CSV data
                        let textarea = document.createElement('textarea');
                        textarea.value = data;
                        document.body.appendChild(textarea);
                        textarea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textarea);

                        // Notify the user
                        alert('CSV data copied to clipboard!');
                    })
                    .catch(error => {
                        console.error('Error copying CSV data:', error);
                    });
            });
            </script>


        <section class="section">
            @if ($data->isEmpty())
                <p>{{ __('No device data found.') }}</p>
            @else
                <table class="table border-separate border-spacing-2 border ">
                    <thead>
                        <tr>
                            <th class="border">{{ __('Device ID') }}</th>
                            <th class="border">{{ __('Sensor Temperature') }}</th>
                            <th class="border">{{ __('Sensor Humidity') }}</th>
                            <th class="border">{{ __('Ambient Temperature') }}</th>
                            <th class="border">{{ __('Ambient Humidity') }}</th>
                            <th class="border">{{ __('Prediction Irrigation amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $device_data)
                            <tr>
                                <td class="border">{{ $device_data->DEVICE_ID }}</td>
                                <td class="border">{{ $device_data->S_TEMP }}</td>
                                <td class="border">{{ $device_data->S_HUM }}</td>
                                <td class="border">{{ $device_data->A_TEMP }}</td>
                                <td class="border">{{ $device_data->A_HUM }}</td>
                                <td class="border">{{ $device_data->PRED_AMOUNT }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </section>
    </main>
    @include('layouts.footer')
    @include('layouts.script')
@endsection
