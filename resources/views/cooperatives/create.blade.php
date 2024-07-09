@extends('layouts.app')

@section('content')
    <h1>Add Cooperative</h1>
    <form action="{{ route('cooperatives.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required></br>
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required></br>
        <label for="services_offered">Services Offered:</label>
        <input type="text" name="services_offered" id="services_offered" required></br>

        {{-- <div class="form-group">
            <label for="farmer_id">Assign farmer</label>
            <select name="farmer_id" id="farmer_id" class="form-control" required>
               @foreach($farmers as $farmer)
                  <option value="{{ $farmer->id }}">{{ $farmer->id }}</option>
               @endforeach
            </select>
        </div> --}}
    </br>
    <button type="submit">Add Cooperative</button>

    </form>
@endsection
