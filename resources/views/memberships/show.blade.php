@extends('layouts.layout')

@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')
    @include('layouts.aside')
    {{-- @include('layouts.graphData') --}}


    <main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-xl font-serif font-semibold">Membership Details</h2>

        <div class="form-group">
            <label for="member_name">Member Name:</label>
            <input type="text" id="member_name" class="form-control" value="{{ $membership->member_name }}" disabled>
        </div>

        <div class="form-group">
            <label for="cooperative_name">Cooperative Name:</label>
            <input type="text" id="cooperative_name" class="form-control" value="{{ $membership->cooperative_name }}" disabled>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" class="form-control" value="{{ $membership->location }}" disabled>
        </div>

        <a href="{{ route('memberships.index') }}" class="btn btn-success mt-3">    <i class="fa fa-arrow-left"></i>Back</a>
    </div>
    </main>
@endsection
