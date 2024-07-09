@extends('layouts.layout')
@section('content')
 
<div class="card">
  <div class="card-header">Edit User</div>
  <div class="card-body">
      
      <form action="{{ url('users/' .$users->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PUT")
        <input type="hidden" name="id" id="id" value="{{$users->id}}" id="id" />
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$users->name}}" class="form-control"></br>
        <label>Address</label></br>
        <input type="text" name="address" id="address" value="{{$users->address}}" class="form-control"></br>
        <label>Mobile</label></br>
        <input type="text" name="mobile" id="mobile" value="{{$users->mobile}}" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
   
  </div>
</div>`
 
@stop