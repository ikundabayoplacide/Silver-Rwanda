@extends('layouts.layout')
@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')

    @include('layouts.aside')

    <main id="main" class="main">
        <p class="text-2xl font-serif font-semibold text-center">{{ __('Visualization of Data') }}</p>
        <div class="mb-4 flex space-x-4 gap-3 float-end">
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
            <button id="copy-button" class="btn btn-gray flex items-center space-x-2">
                <i class="fa fa-copy"></i> Copy
            </button>
        </div>

        <section class="section">
            @if ($data->isEmpty())
                <p>{{ __('No device data found.') }}</p>
            @else
                <table id="data-table" class="table border-separate border-spacing-2 border">
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
                    <tbody id="data-table-body">
                        @foreach ($data as $device_data)
                            <tr id="device-row-{{ $device_data->id }}">
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
                {!! $data->links('pagination::bootstrap-5')!!}
            @endif
        </section>
    </main>
    @include('layouts.footer')
    @include('layouts.script')

    <script>
        if (!!window.EventSource) {
            var source = new EventSource("/sse");

            source.onmessage = function(event) {
                var data = JSON.parse(event.data);
                var tableBody = document.getElementById('data-table-body');

                // Check if the row already exists
                var existingRow = document.getElementById('device-row-' + data.id);
                if (existingRow) {
                    // Update existing row
                    existingRow.innerHTML = `
                        <td class="border">${data.DEVICE_ID}</td>
                        <td class="border">${data.S_TEMP}</td>
                        <td class="border">${data.S_HUM}</td>
                        <td class="border">${data.A_TEMP}</td>
                        <td class="border">${data.A_HUM}</td>
                        <td class="border">${data.PRED_AMOUNT}</td>
                    `;
                } else {
                    // Insert new row
                    var newRow = document.createElement('tr');
                    newRow.id = "device-row-" + data.id;
                    newRow.innerHTML = `
                        <td class="border">${data.DEVICE_ID}</td>
                        <td class="border">${data.S_TEMP}</td>
                        <td class="border">${data.S_HUM}</td>
                        <td class="border">${data.A_TEMP}</td>
                        <td class="border">${data.A_HUM}</td>
                        <td class="border">${data.PRED_AMOUNT}</td>
                    `;
                    tableBody.appendChild(newRow);
                }
            };
        } else {
            alert("Your browser does not support Server-Sent Events.");
        }

        // Script to control the copy button
        document.getElementById('copy-button').addEventListener('click', function() {
            // Create a temporary textarea element
            const textarea = document.createElement('textarea');
            document.body.appendChild(textarea);

            // Get table data
            const table = document.getElementById('data-table');
            const rows = Array.from(table.querySelectorAll('tr'));
            const data = rows.map(row => {
                const cols = Array.from(row.querySelectorAll('td, th'));
                return cols.map(col => col.innerText).join('\t');
            }).join('\n');

            // Set the textarea value and select it
            textarea.value = data;
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Data copied to clipboard!');
        });
    </script>
@endsection
