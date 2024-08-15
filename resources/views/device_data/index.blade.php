@extends('layouts.layout')
@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')

    @include('layouts.aside')

    <main id="main" class="main">
        <p class="text-2xl font-serif font-semibold text-center">{{ __('Device Data List') }}</p>
        <a href="{{ route('device_data.create') }}" class="btn btn-success mb-3">{{ __('Create New Device Data') }}</a>

        <div class="form-group">
            <form action="{{ route('device_data.index') }}" method="GET">
                <div class="form-group">
                    <label for="device_id">{{ __('Select Device:') }}</label>
                    <select name="device_id" id="device_id" class="form-control">
                        <option value="">{{ __('--Select Device--') }}</option>
                        @foreach ($deviceIDs as $deviceID)
                            <option value="{{ $deviceID }}"
                                {{ $selectedDeviceID == $deviceID ? 'selected' : '' }}>
                                {{ $deviceID }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary my-3">{{ __('Submit') }}</button>
            </form>
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
                            <th class="border">{{__('Action')}}</th>
                            <th class="border">{{ __('State') }}</th>
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
                                
                                <td class="border">
                                    {{-- Changed code: Ensure buttons align horizontally --}}
                                    <div class="btn-group gap-2" role="group">
                                        <a href="{{ route('device_data.show', ['device_data' => $device_data->id]) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-eye" aria-hidden="true"></i>{{__('View') }}
                                        </a>
                                        <a href="{{ route('device_data.edit', ['device_data' => $device_data->id]) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>{{__('Edit') }}
                                        </a>
                                        <form action="{{ route('device_data.delete', $device_data->DEVICE_ID) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this device and all its data?');" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash-can"></i> {{__('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                
                                <td class="border">
                                    <form action="{{ route('device_data.toggle', $device_data->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-{{ $device_data->device_state == 1 ? 'success' : ($device_data->device_state == 2 ? 'secondary' : 'warning') }}">
                                            {{ $device_data->device_state == 1 ? 'Activated' : ($device_data->device_state == 2 ? 'Inactive' : 'Initial State') }}
                                        </button>
                                    </form>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex float-end m-3">
                    {!! $data->links('pagination::bootstrap-5')!!}
                </div>
            @endif
        </section>
    </main>
 
    @include('layouts.script')
@endsection
