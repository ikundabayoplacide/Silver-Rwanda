@extends('layouts.layout')

@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')

<main id="main" class="main">
    <div class="container">
        <div class="card">
            <h1 class="viewtitle font-serif text-xl text-center">{{ __('User Details') }}</h1>
            <div class="card-body text-center">
                @if ($user)
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Name') }}: {{ $user->name }}</h5>
                        <h5 class="card-text">{{ __('Email') }}: {{ $user->email }}</h5>
                        <p class="card-text">{{ __('Address') }}: {{ $user->address }}</p>
                        <p class="card-text">{{ __('Phone') }}: {{ $user->phone }}</p>
                    </div>
                @else
                    <p>{{ __('User not found.') }}</p>
                @endif
            </div>
        </div>
    </div>
</main>

@endsection

@include('layouts.footer')
@include('layouts.script')
