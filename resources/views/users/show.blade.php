@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
@section('content')
<main id="main" class="main" style="height: 80vh">
<div class="container">
<div class="card">
  <h1 class="viewtitle">User Details</h1>
  <div class="card-body">
    <div class="card-body">
      <h5 class="card-title">Name : {{ $user->name }}</h5>
      <h5 class="card-text">Email : {{ $user->email }}</h5>
      <p class="card-text">Address : {{ $user->address }}</p>
      <p class="card-text">Phone : {{ $user->phone }}</p>
    </div>
  </div>
</div>
</div>
</main>
@endsection
@include('layouts.footer')
@include('layouts.script')