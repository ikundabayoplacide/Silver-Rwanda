
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.sidebar-user')
<main id="main" class="main" style="height: 80vh">
    <h1 class="text-2xl font-serif font-bold">Add Cooperative</h1><br><br>
    <form action="{{ route('cooperatives.store') }}" method="POST">
        @csrf

        <label for="name" class="text-2xl font-serif font-semibold">Name:</label>
        <input type="text" name="name"style=" padding:3px; border-radius:5px; background:whitesmoke; border:1px solid black" id="name" required></br><br>
        <label for="location" class="text-2xl font-serif font-semibold">Location:</label>
        <input type="text" name="location" style=" padding:3px; border-radius:5px; background:whitesmoke; border:1px solid black"id="location" required></br><br>
        <label for="services_offered" class="text-2xl font-serif font-semibold">Services Offered:</label>
        <input type="text" name="services_offered" style=" padding:3px; border-radius:5px; background:whitesmoke; border:1px solid black"id="services_offered" required></br>

      
    </br>
    <button type="submit" class="btn btn-success">Add Cooperative</button>

    </form>
</main>
@include('layouts.footer')
@include('layouts.script')
