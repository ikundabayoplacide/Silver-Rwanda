@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')

@include('layouts.aside')


<main id="main" class="main" style="height: 80vh">
    <p class="text-2xl font-serif font-semibold text-center">Device Data List</p>
    <a href="{{ route('device_data.create') }}" class="btn btn-success mb-3">Create New Device Data</a>
    <section class="section">
    @if ($data->isEmpty())
        <p>No device data found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Device ID</th>
                    <th>Sensor Temperature</th>
                    <th>Sensor Humidity</th>
                    <th>Ambient Temperature</th>
                    <th>Ambient Humidity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $device_data)
                    <tr>
                        <td>{{ $device_data->DEVICE_ID }}</td>
                        <td>{{ $device_data->S_TEMP }}</td>
                        <td>{{ $device_data->S_HUM }}</td>
                        <td>{{ $device_data->A_TEMP }}</td>
                        <td>{{ $device_data->A_HUM }}</td>
                        <td>
                            <a href="{{ route('device_data.show', ['device_data' => $device_data->id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('device_data.edit', ['device_data' => $device_data->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('device_data.destroy', ['device_data' => $device_data->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this device data?')">Delete</button>
                            </form>
                        </td>
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
