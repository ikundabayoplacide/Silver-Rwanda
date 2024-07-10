@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.sidebar-user')
<main id="main" class="main" style="height: 80vh">
    <div class="card">
        <div class="card-header">
            <p class="text-2xl  text-center font-serif font-semibold">Device Data Details</p>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $device_data->id }}</td>
                </tr>
                <tr>
                    <th>Device ID</th>
                    <td>{{ $device_data->DEVICE_ID }}</td>
                </tr>
                <tr>
                    <th>Sensor Temperature (S_TEMP)</th>
                    <td>{{ $device_data->S_TEMP }}</td>
                </tr>
                <tr>
                    <th>Sensor Humidity (S_HUM)</th>
                    <td>{{ $device_data->S_HUM }}</td>
                </tr>
                <tr>
                    <th>Ambient Temperature (A_TEMP)</th>
                    <td>{{ $device_data->A_TEMP }}</td>
                </tr>
                <tr>
                    <th>Ambient Humidity (A_HUM)</th>
                    <td>{{ $device_data->A_HUM }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $device_data->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $device_data->updated_at }}</td>
                </tr>
            </table>

            <div class="btn-group" role="group">
                <a href="{{ route('device_data.edit', $device_data->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('device_data.destroy', $device_data->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?');">Delete</button>
                </form>

                <a href="{{ route('device_data.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</main>
@include('layouts.footer')
@include('layouts.script')
@endsection
