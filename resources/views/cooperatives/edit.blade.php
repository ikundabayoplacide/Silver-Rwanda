@extends('layouts.app')

@section('content')
    <h1>Edit Cooperative</h1>
    <form action="{{ route('cooperatives.update', $cooperative) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $cooperative->name }}" required>
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" value="{{ $cooperative->location }}" required>
        <label for="services_offered">Services Offered:</label>
        <input type="text" name="services_offered" id="services_offered" value="{{ $cooperative->services_offered }}" required>
        <button type="submit">Update Cooperative</button>
    </form>
@endsection
