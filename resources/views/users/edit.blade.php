@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
@section('content')
<main id="main" class="main" style="height: 80vh">
<div class="card">
  <div class="card-header"> <p class="text-xl font-serif ml-5">{{__('Edit User')}}</p></div>
  <div class="card-body">

      <form action="{{ url('users/' .$user->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PUT")
        <input type="hidden" name="id" id="id" value="{{$user->id}}" id="id" />
        <label>{{__('Name')}}</label></br>
        <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control"></br>
        <label>{{__('Email')}}</label></br>
        <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control"></br>
        <label>{{__('Role')}}</label></br>
        <input type="text" name="role" id="role" value="{{$user->role}}" class="form-control"></br>
        <label>{{__('Address')}}</label></br>
        <input type="text" name="address" id="address" value="{{$user->address}}" class="form-control"></br>
        <label>{{__('Phone')}}</label></br>
        <input type="text" name="phone" id="phone" value="{{$user->phone}}" class="form-control"></br>
        <input type="submit" value="{{__('Update')}}" class="btn btn-success"></br>
    </form>

  </div>
</div>
</main>
@stop
@include('layouts.footer')
@include('layouts.script')