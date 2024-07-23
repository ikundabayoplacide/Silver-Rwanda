
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
    <div class="container">
        <h1>Assignment Details</h1>

        <!-- Display Success Message if exists -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Check if there is any assignment data -->
        @if(!empty($details))
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Farmer Name</th>
                        <th>Cooperative Name</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $data) {
                    <tr>
                        <td>{{ $data['member_name'] }}</td>
                        <td>{{ $data['cooperative_name'] }}</td>
                        <td>{{ $data['location'] }}</td>
                    </tr>}
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No assignment data available. Please assign a farmer to a cooperative first.</p>
        @endif

        <!-- Link to go back to the assignment form -->
        <a href="{{ route('cooperatives.showAssignForm') }}" class="btn btn-primary mt-4">Assign Another Farmer</a>
    </div>
</main>
@include('layouts.footer')
@include('layouts.script')
