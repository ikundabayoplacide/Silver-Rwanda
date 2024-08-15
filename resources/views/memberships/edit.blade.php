@extends('layouts.layout')

@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')
    @include('layouts.aside')
    {{-- @include('layouts.graphData') --}}


    <main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-xl font-serif font-semibold">Edit Membership</h2>

        <form action="{{ route('memberships.update', $membership->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="member_name">Member Name:</label>
                <input type="text" id="member_name" name="member_name" class="form-control" value="{{ $membership->member_name }}" required>
            </div>

            <div class="form-group">
                <label for="cooperative_name">Cooperative Name:</label>
                <input type="text" id="cooperative_name" name="cooperative_name" class="form-control" value="{{ $membership->cooperative_name }}" required>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ $membership->location }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Membership</button>
        </form>
    </div>
    </main>
@endsection
