@extends('layouts.layout')

@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')
    @include('layouts.aside')
    {{-- @include('layouts.graphData') --}}


    <main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-xl font-semibold font-serif ">{{__('Membership List')}}</h2>
        {{-- <a href="{{ route('memberships.create') }}" class="btn btn-primary">Add Membership</a> --}}
        {{-- <div class="col-md-4">
            <div class="form-group">
                <form action="/searching" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="search...." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">{{__('Search')}}</button>
                    </div>
                </form>
            </div>
            </div> --}}

        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('Member Name')}}</th>
                    <th>{{__('Cooperative Name')}}</th>
                    <th>{{__('Location')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($memberships as $membership)
                    <tr>
                        <td>{{ $membership->id }}</td>
                        <td>{{ $membership->member_name }}</td>
                        <td>{{ $membership->cooperative_name }}</td>
                        <td>{{ $membership->location }}</td>
                        <td>
                            <a href="{{ route('memberships.show', $membership->id) }}" class="btn btn-info"> <i class="fa fa-eye" aria-hidden="true"></i>{{__('View')}}</a>
                            <a href="{{ route('memberships.edit', $membership->id) }}" class="btn btn-warning">     <i class="fa-solid fa-pen-to-square"></i>{{__('Edit')}}</a>
                            <form action="{{ route('memberships.destroy', $membership->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i>{{__('Delete')}}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
<div class="flex float-end">
        {!! $memberships->links('pagination::bootstrap-5') !!}
    </div>
    </div>
</main>
@endsection
