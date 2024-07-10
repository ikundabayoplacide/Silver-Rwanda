
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.sidebar-user')
<main id="main" class="main" style="height: 80vh">
    <p class="text-2xl font-serif font-bold">Cooperatives Management</p><br>
    <a href="{{ route('cooperatives.create') }}" > <button class="btn btn-success">Add New Cooperative</button></a>
    <ol>
        @foreach($cooperatives as $cooperative)
        <li>
            <a href="{{ route('cooperatives.show', $cooperative) }}">{{ $cooperative->name }}</a>
        </li>
        @endforeach
    </ol>
</main>
@include('layouts.footer')
@include('layouts.script')
