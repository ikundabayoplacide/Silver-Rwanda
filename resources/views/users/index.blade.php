@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
    <h1 class="text-2xl mb-2 font-serif font-semibold underline"> List Of All Users</h1>
    <div class="pull-right">
        @can('create-user')
        <a class="btn btn-success btn-sm mb-2 float-end" href="{{ route('admin.register') }}">
            <i class="fa fa-plus"></i> Create New User
        </a>
        @endcan
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        <a href="{{ url('/users/' . $item->id) }}" title="View User">
                            <button class="btn btn-info btn-sm">
                                <i class="fa fa-eye" aria-hidden="true"></i> View
                            </button>
                        </a>
                        @can('edit-user')
                        <a href="{{ url('/users/' . $item->id . '/edit') }}" title="Edit User">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                        </a>
                        @endcan
                        @can('delete-user')
                        <form method="POST" action="{{ url('/users/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"title="Delete User">
                                <i class="fa-solid fa-trash-can"></i> Delete
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $users->links('pagination::bootstrap-5') !!}
</main>
@endsection

@include('layouts.footer')
@include('layouts.script')
