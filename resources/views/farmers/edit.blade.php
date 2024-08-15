

@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
<div class="container">
    <h2 class="text-2xl font-serif font-bold">{{__('Edit Farmer Details')}}</h2> <br>
    <form action="{{ route('farmers.update', ['farmers' => $farmers->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id">{{__('Farmer ID')}}</label>
            <input type="number" class="form-control"  name="id"
                value="{{ old('id', $farmers->id) }}" required>
        </div>

        <div class="form-group">
            <label for="name">{{__('Name:')}} </label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name',  $farmers->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">{{__('Email')}}</label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email',$farmers->email) }}" required>
        </div>

        <div class="form-group">
            <label for="district">{{__('District')}}</label>
            <input type="text" class="form-control" id="district" name="district"
                value="{{ old('district', $farmers->district ) }}" required>
        </div>

        <div class="form-group">
            <label for="phone">{{__('Phone')}}</label>
            <input type="number" class="form-control" id="phone" name="phone"
                value="{{ old('phone', $farmers->phone) }}" required>
        </div> <br>

        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
    </form>
</div>
</main>

@include('layouts.script')


