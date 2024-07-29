

@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
<body>
    <div class="container mt-5">

        <p class="text-2xl font-serif font-bold">{{__('Farmer Registration')}}</p><br>
        <form action="{{ route('farmers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{__('Name')}}</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">{{__('Email')}}</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">{{__('District')}}</label>
                <input type="text" id="email" name="district" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">{{__('Phone')}}</label>
                <input type="number" id="email" name="phone" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">{{__('Password')}}</label>
                <input type="password" id="password" name="confirm_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">{{__('Confirm Password')}}</label>
                <input type="password" id="password_confirmation" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="device_id">{{__('Select Device')}}</label>
                <select id="device_id" name="device_id" class="form-control" required>
                    @foreach($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->id }}</option>
                    @endforeach
                </select>
            </div>
            <div><br>
                <label class="font-bold font-serif text-xl">{{__('Gender')}}</label>
              
                    <input class="form-check-input text-2xl" type="radio" name="gender" id="gender" value="male">{{__('Male')}}
                    <input class="form-check-input text-2xl" type="radio" name="gender" id="gender" value="female">{{__('Female')}}
                 
                </div></br>

            <button type="submit" class="btn btn-primary">{{__('Register')}}</button>
        </form>
    </div>
</body>
@include('layouts.footer')
@include('layouts.script')
