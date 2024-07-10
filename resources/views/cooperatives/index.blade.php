@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.sidebar-user')

<main id="main" class="main" style="height: 80vh">
    <p class="text-2xl font-serif font-bold underline">Cooperatives Management</p><br>
    <a href="{{ route('cooperatives.create') }}" > <button class="btn btn-info text-2xl">Add New Cooperative</button></a><br><br>
    <ol style="list-style-type: decimal; padding-left: 20px;">
        @foreach($cooperatives as $cooperative)
        <li class="text-2xl font-serif font-semibold" style="margin-bottom: 10px; list-style-capitalize">
            <a href="{{ route('cooperatives.show', $cooperative) }}">
                <i class="fas fa-users list-item-icon"></i>{{ $cooperative->name }}</a>
        </li>


        @endforeach
    </ol>
</main>

@include('layouts.footer')
@include('layouts.script')
@endsection
