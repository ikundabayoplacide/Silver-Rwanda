@extends('layouts.layout')

@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')
    @include('layouts.aside')
    {{-- @include('layouts.graphData') --}}


    <main id="main" class="main">
    <div class="container mt-5">
        <h2 class="text-xl font-semibold font-serif ">Membership List</h2>
        {{-- <a href="{{ route('memberships.create') }}" class="btn btn-primary">Add Membership</a> --}}

        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Member Name</th>
                    <th>Cooperative Name</th>
                    <th>Location</th>
                    <th>Actions</th>
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
                            <a href="{{ route('memberships.show', $membership->id) }}" class="btn btn-info"> <i class="fa fa-eye" aria-hidden="true"></i>View</a>
                            <a href="{{ route('memberships.edit', $membership->id) }}" class="btn btn-warning">     <i class="fa-solid fa-pen-to-square"></i>Edit</a>
                            <form action="{{ route('memberships.destroy', $membership->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i>Delete</button>
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
