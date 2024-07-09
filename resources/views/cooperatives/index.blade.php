@extends('layouts.app')

@section('content')
    <h1>Cooperatives</h1>
    <a href="{{ route('cooperatives.create') }}">Add New Cooperative</a>
    <ul>
        @foreach($cooperatives as $cooperative)
            <li><a href="{{ route('cooperatives.show', $cooperative) }}">{{ $cooperative->name }}</a></li>
        @endforeach
    </ul>
@endsection
