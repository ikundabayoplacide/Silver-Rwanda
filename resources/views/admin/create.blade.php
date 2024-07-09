@extends('layouts.layout')
@section('content')
  
    <div class="card">
        <div class="card-header">
            <p class=" text-center text-3xl font-serif text-red-500"> Admin Register Form</p>
        </div>
        <div class="flex justify-center">
        
            <form action= "{{ route('admin.register') }}" method="post" class="bg-slate-300 rounded p-40">
                
             {!! csrf_field() !!}   
             
            <label class="font-bold font-serif">First Name:</label>
            <input type="text" name="name" id="name" class =" flex w-80 p-4 h-4 rounded"> </br>
      
            <label class="font-bold font-serif">Email:</label>
            <input type="email" name="email" id="email" class ="flex w-80 p-4 h-4 rounded"> </br>
            <label class="font-bold font-serif">Password:</label>

            <input type="password" name="password" id="password" class ="flex w-80 p-4 h-4 rounded"> </br>


            <input type="submit" value="Register" class="btn btn-success"> 
        
            </form>
        </div>
    </div>
@stop