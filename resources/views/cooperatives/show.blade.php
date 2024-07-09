@extends('layouts.app')

@section('content')
    <h1>{{ $cooperative->name }}</h1>
    <p>Location: {{ $cooperative->location }}</p>
    <p>Services: {{ $cooperative->services_offered }}</p>
    <a href="{{ route('cooperatives.edit', $cooperative) }}">Edit</a>
    <form action="{{ route('cooperatives.destroy', $cooperative) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
