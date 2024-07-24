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
        <table class="table border-separate border-spacing-2 border">
            <thead>
                <tr>
                    <th class="border">Device ID</th>
                    <th class="border">Sensor Temperature</th>
                    <th class="border">Sensor Humidity</th>
                    <th class="border">Ambient Temperature</th>
                    <th class="border">Ambient Humidity</th>
                    <th class="border">Actions</th>
                    <th class="border">ON/OFF</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $device_data)
                    <tr>
                        <td  class="border">{{ $device_data->DEVICE_ID }}</td>
                        <td  class="border">{{ $device_data->S_TEMP }}</td>
                        <td class="border">{{ $device_data->S_HUM }}</td>
                        <td class="border">{{ $device_data->A_TEMP }}</td>
                        <td class="border">{{ $device_data->A_HUM }}</td>
                        <td class="border">
                            <a href="{{ route('device_data.show', ['device_data' => $device_data->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>View</a>
                            <a href="{{ route('device_data.edit', ['device_data' => $device_data->id]) }}" class="btn btn-primary btn-sm"> <i class="fa-solid fa-pen-to-square"></i>Edit</a>
                            <form action="{{ route('device_data.destroy', ['device_data' => $device_data->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this device data?')">   <i class="fa-solid fa-trash-can"></i> Delete</button>
                            </form>
                           
                        </td>
                        <td class="border"> 
                            <form action="{{ route('device_data.toggle', $device_data->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-{{ $device_data->device_state == 1 ? 'secondary' : 'success' }}">
                                    {{ $device_data->device_state == 1 ? 'Deactivate' : 'Activate' }}
                                </button>
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
