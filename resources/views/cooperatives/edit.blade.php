
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
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
</main>
@include('layouts.footer')
@include('layouts.script')
