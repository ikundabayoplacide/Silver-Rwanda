@extends('layouts.layout')
@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')

    @include('layouts.aside')


    <main id="main" class="main">
        <p class="text-2xl font-serif font-semibold text-center">{{ __('Visualization of Data') }}</p>
        <div class="mb-4">
            <a href="{{ route('device_data.display', ['download' => 'pdf']) }}" class="btn btn-primary" style="background-color: rgb(193, 5, 5)" >
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
            <a href="{{ route('device_data.display', ['download' => 'excel']) }}" class="btn btn-secondary" style="background-color: rgb(6, 125, 3)">
                <i class="fas fa-file-excel"></i> Download Excel
            </a>
        </div>

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
