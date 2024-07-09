@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Assign Farmer to Cooperative</h1>

        <form action="{{ route('cooperatives.assign') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cooperative">Select Cooperative:</label>
                <select name="cooperative_id" id="cooperative" class="form-control">
                    @foreach ($cooperatives as $cooperative)
                        <option value="{{ $cooperative->id }}">{{ $cooperative->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="farmer">Select Farmer:</label>
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

            <button type="submit" class="btn btn-primary">Assign</button>
        </form>
    </div>
@endsection
