@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.sidebar-user')

<main id="main" class="main p-4" style="height: 80vh">
    <p class="h4 font-weight-bold mb-4">Cooperatives Management</p>
    <a href="{{ route('cooperatives.create') }}" class="mb-4 d-inline-block">
        <button class="btn btn-success">Add New Cooperative</button>
    </a>
    <ol class="ml-4" style="list-style-type: decimal;">
        @foreach($cooperatives as $cooperative)
            <li class="mb-2">
                <a href="{{ route('cooperatives.show', $cooperative) }}" class="text-primary">
                    <i class="fas fa-users mr-2"></i>{{ $cooperative->name }}
                </a>
            </li>
        @endforeach
    </ol>
</main>

@include('layouts.footer')
@include('layouts.script')
@endsection
