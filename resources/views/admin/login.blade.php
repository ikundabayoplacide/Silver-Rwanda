@extends('layouts.layout')
@section('content')
  <div class="card">
    <div class="card-header bg-black">
        <p class="text-center font-serif font-bold underline text-2xl text-white "> Admin Login</p>
    </div>
    <div class="flex justify-center">  
        <form  action="{{ route('admin.check') }}" method="POST" class="bg-slate-300 rounded p-40">
                        {!! csrf_field() !!}   
                        @include('-message')
                        <div class="mb-3">
                            <label class="form-label font-serif font-bold">Email address:</label>
                            <input type="email" class="form-control p-2"name="email">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                          </div>
                          <div class="mb-3">
                            <label  class="form-label font-serif font-bold">Password:</label>
                            <input type="password" class="form-control p-2" name="password">
                          </div>
                          <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> 
            </div>
 @stop