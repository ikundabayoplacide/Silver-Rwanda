@extends('layouts.layout')
@section('content')
 
 
<div class="card">
  <h1 class="viewtitle">User Details</h1>
  <div class="card-body">
   
 
 <div class="card-body">
  <h5 class="card-title">Name : {{ $users->name }}</h5>
  <p class="card-text">Address : {{ $users->address }}</p>
  <p class="card-text">Phone : {{ $users->mobile }}</p>
  </div>
       
    </hr>
  
  </div>
</div>