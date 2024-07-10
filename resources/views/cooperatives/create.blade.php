@extends('layouts.layout')
@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')
    @include('layouts.sidebar-user')
    <main id="main" class="main" style="height: 80vh">
        <h1 class="text-2xl font-serif font-bold">Add Cooperative</h1><br><br>
        <form action="{{ route('cooperatives.store') }}" method="POST">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="type cooperative's name" id="name" required></br><br>
            <label for="location">Location:</label>
            <input type="text" name="location" placeholder=" type cooperative's location" id="location"
                required></br><br>
            <label for="services_offered">Services Offered:</label>
            <input type="text" name="services_offered" placeholder=" type cooperative's services"id="services_offered"
                required></br>

            {{-- <div class="form-group">
            <label for="farmer_id">Assign farmer</label>
            <select name="farmer_id" id="farmer_id" class="form-control" required>
               @foreach ($farmers as $farmer)
                  <option value="{{ $farmer->id }}">{{ $farmer->id }}</option>
               @endforeach
            </select>
        </div> --}}

            </br>
            <button type="submit" class="btn btn-success">Add Cooperative</button>

        </form>
    </main>
    @include('layouts.footer')
    @include('layouts.script')
