@extends('layouts.layout')

@section('content')
<div class="card mt-5">
    <div class="card-header bg-black">
        <p class="text-center font-serif font-bold underline text-2xl text-white">Admin Login</p>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.check') }}" method="POST">
            {!! csrf_field() !!}
            {{-- @include('partials.message') <!-- Make sure this partial exists --> --}}
            <div class="mb-3">
                <label class="form-label font-serif font-bold">Email address:</label>
                <input type="email" class="form-control p-2" name="email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label class="form-label font-serif font-bold">Password:</label>
                <input type="password" class="form-control p-2" name="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ url('admin/register') }}" class="ms-2 text-decoration-none text-primary"><i class="fa-solid fa-arrow-left"></i> Click here to Register</a>
        </form>
    </div>
</div>
@endsection
