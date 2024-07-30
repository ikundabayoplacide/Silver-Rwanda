@extends('layouts.layout')
@section('content')
    @include('layouts.head-part')
    @include('layouts.header-content')
    @include('layouts.aside')
    <main id="main" class="main">
        <div class="row">
            <div class="col-lg-12 margin-tb">

                <h2 class="text-2xl font-serif font-semibold underline">{{ __('Role Management') }}</h2>

                <div class="flex float-end">
                    @can('role-create')
                        <a class="btn btn-success btn-sm mb-3 text-xl" href="{{ route('roles.create') }}"><i
                                class="fa fa-plus"></i> {{ __('Create New Role') }}</a>
                    @endcan
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th width="100px">{{ __('No') }}</th>
                <th>{{ __('Name') }}</th>
                <th width="280px">{{ __('Action') }}</th>
            </tr>
            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}"><i
                                class="fa-solid fa-list"></i> {{ __('Show') }}</a>
                        @can('role-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}"><i
                                    class="fa-solid fa-pen-to-square"></i>{{ __('Edit') }}</a>
                        @endcan
                        @can('role-delete')
                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-danger btn-sm "onclick="return confirm('Are you sure you want to delete this role?')">
                                    <i class="fa-solid fa-trash"></i>{{ __('Delete') }}</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $roles->links('pagination::bootstrap-5') !!}

    </main>
@endsection
@include('layouts.footer')
@include('layouts.script')
