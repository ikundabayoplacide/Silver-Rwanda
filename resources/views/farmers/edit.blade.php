

@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
<div class="container">
    <h2 class="text-2xl font-serif font-bold">Edit Farmer Details</h2> <br>
    <form action="{{ route('farmers.update', ['farmers' => $farmers->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="DEVICE_ID">Farmer ID</label>
            <input type="text" class="form-control" id="DEVICE_ID" name="DEVICE_ID"
                value="{{ old('Farmer_ID', $farmers->id) }}" required>
        </div>

        <div class="form-group">
            <label for="S_TEMP">Name </label>
            <input type="number" class="form-control" id="S_TEMP" name="S_TEMP"
                value="{{ old('Name', $farmers->Name) }}" required>
        </div>

        <div class="form-group">
            <label for="S_HUM">Email</label>
            <input type="number" class="form-control" id="S_HUM" name="S_HUM"
                value="{{ old('Email', $farmers->Email) }}" required>
        </div>

        <div class="form-group">
            <label for="A_TEMP">District </label>
            <input type="number" class="form-control" id="A_TEMP" name="A_TEMP"
                value="{{ old('District', $farmers->District) }}" required>
        </div>

        <div class="form-group">
            <label for="A_HUM">Phone</label>
            <input type="number" class="form-control" id="A_HUM" name="A_HUM"
                value="{{ old('Phone', $farmers->Phone) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</main>
@include('layouts.footer')
@include('layouts.script')


