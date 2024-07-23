
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main">
    <div class="container">
        <h1 class="text-center text-xl font-serif font-bold">Assign Farmer to Cooperative</h1>

        <form action="{{ route('cooperatives.assign') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cooperative" class="font-xl font-serif font-semibold">Select Cooperative:</label>
                <select name="cooperative_id" id="cooperative" class="form-control">
                    @foreach ($cooperatives as $cooperative)
                        <option value="{{ $cooperative->id }}">{{ $cooperative->name }}</option>
                    @endforeach
                </select>
            </div> <br>

            <div class="form-group">
                <label for="farmer" class="font-xl font-serif font-semibold">Select Farmer:</label>
                <select name="farmer_id" id="farmer" class="form-control">
                    @foreach ($farmers as $farmer)
                        <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                    @endforeach
                </select>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <button type="submit" class="btn btn-primary mt-3  font-bold">Assign</button>
        </form>
    </div>
</main>

@include('layouts.script')
