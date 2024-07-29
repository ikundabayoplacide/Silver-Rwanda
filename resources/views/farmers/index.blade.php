
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
<div class="container">
    <p class="text-2xl font-serif font-bold">{{__('Farmers Data List')}}</p><br>
    <a href="{{ route('farmers.register') }}" class="btn btn-success mb-3">{{__('Create New farmers Datails')}}</a>

    @if ($farmers->isEmpty())
        <p>{{__('No farmers data found.')}}</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>{{__('Farmer ID')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('District')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($farmers as $farmer)
                    <tr>
                        <td>{{ $farmer->id }}</td>
                        <td>{{ $farmer->name }}</td>
                        <td>{{ $farmer->email }}</td>
                        <td>{{ $farmer->district }}</td>
                        <td>{{ $farmer->phone }}</td>
                        <td>
                            <a href="{{ route('farmers.show', ['farmers' => $farmer->id]) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-list"></i>{{__('View')}}</a>
                            <a href="{{ route('farmers.edit', ['farmers' => $farmer->id]) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i>{{__('Edit')}}</a>
                            <form action="{{ route('farmers.destroy', ['farmers' => $farmer->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Farm?')"><i class="fa-solid fa-trash" ></i>{{__('Delete')}}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</main>
@include('layouts.footer')
@include('layouts.script')
