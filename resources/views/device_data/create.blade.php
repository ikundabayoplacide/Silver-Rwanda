@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Add New Device Data</h2>
    <form action="{{ route('device_data.store') }}" method="POST">
        @csrf
        @include('device_data.partials.form')
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
