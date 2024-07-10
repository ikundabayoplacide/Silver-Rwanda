
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.sidebar-user')
<main id="main" class="main" style="height: 80vh">
    <p class="text-2xl font-serif font-semibold text-center">Edit Cooperative</p><br>
    <form action="{{ route('cooperatives.update', $cooperative) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="rounded-sm border-spacing-3 border-black" value="{{ $cooperative->name }}" required>
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" value="{{ $cooperative->location }}" required>
        <label for="services_offered">Services Offered:</label>
        <input type="text" name="services_offered" id="services_offered" value="{{ $cooperative->services_offered }}" required>
        <button type="submit">Update Cooperative</button>
    </form>
</main>
@include('layouts.footer')
@include('layouts.script')
