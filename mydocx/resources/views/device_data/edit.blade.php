
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Device Data</h2>
    <form action="{{ route('device_data.update', ['device_data' => $device_data->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="DEVICE_ID">Device ID</label>
            <input type="text" class="form-control" id="DEVICE_ID" name="DEVICE_ID"
                value="{{ old('DEVICE_ID', $device_data->DEVICE_ID) }}" required>
        </div>

        <div class="form-group">
            <label for="S_TEMP">Sensor Temperature (S_TEMP)</label>
            <input type="number" class="form-control" id="S_TEMP" name="S_TEMP"
                value="{{ old('S_TEMP', $device_data->S_TEMP) }}" required>
        </div>

        <div class="form-group">
            <label for="S_HUM">Sensor Humidity (S_HUM)</label>
            <input type="number" class="form-control" id="S_HUM" name="S_HUM"
                value="{{ old('S_HUM', $device_data->S_HUM) }}" required>
        </div>

        <div class="form-group">
            <label for="A_TEMP">Ambient Temperature (A_TEMP)</label>
            <input type="number" class="form-control" id="A_TEMP" name="A_TEMP"
                value="{{ old('A_TEMP', $device_data->A_TEMP) }}" required>
        </div>

        <div class="form-group">
            <label for="A_HUM">Ambient Humidity (A_HUM)</label>
            <input type="number" class="form-control" id="A_HUM" name="A_HUM"
                value="{{ old('A_HUM', $device_data->A_HUM) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection


