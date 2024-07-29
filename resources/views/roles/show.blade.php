@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
@section('content')
<main id="main" class="main" style="height: 80vh">
<div class="row">
    <div class="col-lg-12 margin-tb">
      
            <h2 class="text-xl font-serif font-semibold mb-2">{{__('Show Role')}}</h2>
    
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left"></i>{{__('Back')}}</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
        <div class="form-group">
            <strong>{{__('Name:')}}</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
        <div class="form-group">
            <strong>{{__('Permissions:')}}</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
</main>
@include('layouts.footer')
@include('layouts.script')