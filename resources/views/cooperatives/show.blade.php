
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
    <h1 class="text-3xl font-serif font-bold">{{ $cooperative->name }}</h1> <br>
    <p class="text-2xl font-serif font-semibold">Location: {{ $cooperative->location }}</p><br>
    <p class="text-2xl font-serif font-semibold">Services: {{ $cooperative->services_offered }}</p><br>
    <div class="flex">
  
    <form action="{{ route('cooperatives.destroy', $cooperative) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-success"><a href="{{ route('cooperatives.edit', $cooperative) }}" >Edit</a></button> 
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
</main>
@include('layouts.footer')
@include('layouts.script')
