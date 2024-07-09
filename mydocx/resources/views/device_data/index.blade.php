{{--
@extends('layouts.app')
@section('content')
<div class="container">
    <a href="{{ route('device_data.create') }}" class="btn btn-primary">Add New Device Data</a>
    <table class="table">
       <thead>
        <tr>
            <th>ID</th>
            <th>S_TEMP</th>
            <th>S_HUM</th>
            <th>A_TEMP</th>
            <th>A_HUM</th>
            <th>Actions</th>
            <th>Device ID</th>
        </tr>
       </thead>

       <tbody>
          @foreach ($data as $item)
             <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->DEVICE_ID }}</td>
                <td>{{ $item->S_TEMP}}</td>
                <td>{{ $item->S_HUM }}</td>
                <td>{{ $item->A_TEMP}}</td>
                <td>{{ $item->A_HUM}}</td>

                <td>
                    <a href="{{ route('device_data.show',$item->id) }} " class="btn btn-info">View</a>
                    <a href="{{ route('device_data.edit',$item->id) }} " class="btn btn-warning">View</a>
                    <form action="{{ route('device_data.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
             </tr>

          @endforeach
       </tbody>
    </table>
</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Device Data List</h2>
    <a href="{{ route('device_data.create') }}" class="btn btn-success mb-3">Create New Device Data</a>

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
</div>
@endsection
