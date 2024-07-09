@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
    <section class="section">
    <h2 class="text-2xl font-serif font-bold">Add New Device Data</h2><br>
    <form action="{{ route('device_data.store') }}" method="POST">
        @csrf
        @include('device_data.partials.form')
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</section>
</main>
@include('layouts.footer')
@include('layouts.script')
@endsection

