
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
    <p class="text-2xl font-serif font-bold ">Edit Cooperative</p><br>
    <form action="{{ route('cooperatives.update', $cooperative) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name" class="text-xl font-serif font-bold">Name:</label>
        <input type="text" name="name" id="name" style=" padding:3px; border-radius:5px; background:whitesmoke; border:1px solid black"value="{{ $cooperative->name }}" required><br><br>
        <label for="location" class="text-xl font-serif font-bold">Location:</label>
        <input type="text" name="location" style=" padding:3px; border-radius:5px; background:whitesmoke; border:1px solid black" id="location" value="{{ $cooperative->location }}" required><br><br>
        <label for="services_offered" class="text-xl font-serif font-bold">Services Offered:</label>
        <input type="text" name="services_offered" style=" padding:6px; border-radius:5px; background:whitesmoke; border:1px solid black" id="services_offered" value="{{ $cooperative->services_offered }}" required><br><br>
        <button type="submit" class="btn btn-primary">Update Cooperative</button>
    </form>
</main>
@include('layouts.footer')
@include('layouts.script')
