@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
@section('content')

        <div class="flex justify-center">

            <form action= "{{ route('admin.register') }}" method="post" class="bg-slate-300 rounded p-40">
                {!! csrf_field() !!}
                <p class="text-center text-3xl font-serif text-red-500 underline" style="margin-bottom:30px"> Register Form</p>
               <div class="grid grid-cols-2 gap-4">
                <div>
                <label class="font-bold font-serif">First Name</label>
                <input type="text" name="name" id="name" class="flex w-80 h-3 p-4 rounded"> </br>
                </div>
                 <div>
                <label class="font-bold font-serif">Email</label>
                <input type="email" name="email" id="email" class="flex w-80 h-3 p-4 rounded"> </br>
                </div>
               <div>
                <label class="font-bold font-serif">Password</label>
                <input type="password" name="password" id="password" class="flex w-80 h-3 p-4 rounded"> </br>
              </div>
                <div>
                <label class="font-bold font-serif">Address</label>
                <input type="text" name="address" id="address" class="flex w-80 h-3 p-4 rounded"> </br>
                </div>
                 <div>
                <label class="font-bold font-serif">Phone</label>
                <input type="text" name="phone" id="phone" class="flex w-80 h-3 p-4 rounded"> </br>
                </div>
                <div>
                {{-- <label class="font-bold font-serif">Role</label>
                <select name="role" id="role" class="flex w-80 h-3 p-4 rounded ">
                    <option value="rab">Rab</option>
                    <option value="sedo">Sedo</option>
                    <option value="naeb">NAEB</option>
                    <option value="cooperative_manager">Cooperative Manager</option>
                    <option value="sector_agronome">Sector Agronome</option>
                    <option value="district_agronome">District Agronome</option>
                    <option value="self-farmer" >Self Farmer</option>

                </select> </br> --}}


            </div>

               <div>
                <label class="font-bold font-serif text-xl">Gender</label>

                    <input class="form-check-input text-2xl" type="radio" name="gender" id="gender" value="male">Male
                    <input class="form-check-input text-2xl" type="radio" name="gender" id="gender" value="female">Female

                </div>
             </div> </br>
                <input type="submit" value="Register" class="btn btn-success text-xl" >


            </form>

    </div>
@stop
