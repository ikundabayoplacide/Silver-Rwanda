
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
    <p class="text-2xl font-serif font-bold">Cooperatives</p><br>
    <a href="{{ route('cooperatives.create') }}" > <p class="text-xl font-sans font-semibold">Add New Cooperative</p></a>
    <ul>
        @foreach($cooperatives as $cooperative)
            <li><a href="{{ route('cooperatives.show', $cooperative) }}">{{ $cooperative->name }}</a></li>
        @endforeach
    </ul>
</main>
@include('layouts.footer')
@include('layouts.script')
