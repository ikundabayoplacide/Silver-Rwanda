@extends('layouts.layout')
@section('content')
<div class="card">
    <div class="card-header bg-black">
        <p class="text-center font-serif font-bold underline text-2xl text-white">
            {{ __('Admin Login') }}  </p>
    </div>
    <div class="flex justify-center">
        <form action="{{ route('admin.check') }}" method="POST" class="bg-slate-300 rounded p-40">
            {!! csrf_field() !!}
            @include('-message')
          
            <div class="mb-3">
             
                <label class="form-label font-serif font-bold">{{ __('Email address:') }}</label>
                <input type="email" class="form-control p-2" name="email">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xl"/>
            </div>
            <div class="mb-3">
                <label class="form-label font-serif font-bold">{{ __('Password:') }}</label>
                <input type="password" class="form-control p-2" name="password">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xl"/>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">{{ __('Check me out') }}</label>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            <a href="{{ url('admin/register') }}" style="margin-left:10px;color:rgb(56, 56, 210)">
                <i class="fa-solid fa-arrow-left"></i> {{ __('Click here to Register') }}
            </a>
           
            <div class="d-flex align-items-center gap-4 mt-4">
                <select id="languageSelect" class="form-select" aria-label="Default select example">
                  <option value="{{ route('user.lang', ['lang' => 'en']) }}" class="text-xl font-serif " {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                  <option value="{{ route('user.lang', ['lang' => 'kiny']) }}" class="text-xl font-serif" {{ app()->getLocale() == 'kiny' ? 'selected' : '' }}>Kinyarwanda</option>
                </select>
              </div>
              
              <script>
                document.getElementById('languageSelect').addEventListener('change', function() {
                  var selectedValue = this.value;
                  if (selectedValue) {
                    window.location.href = selectedValue;
                  }
                });
              </script>
        </form>
      

      
        

    </div>
</div>
@stop
