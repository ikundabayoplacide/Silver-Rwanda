
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.sidebar-user')

<main id="main" class="main" style="height: 80vh">
    <h1>{{ $cooperative->name }}</h1>
    <p>Location: {{ $cooperative->location }}</p>
    <p>Services: {{ $cooperative->services_offered }}</p>
    <a href="{{ route('cooperatives.edit', $cooperative) }}" class="btn btn-success">Edit</a>
    <form action="{{ route('cooperatives.destroy', $cooperative) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</main>

@include('layouts.footer')
@include('layouts.script')
