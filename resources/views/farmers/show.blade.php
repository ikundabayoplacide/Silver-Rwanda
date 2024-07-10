
@extends('layouts.layout')
@section('content')
@include('layouts.head-part')
@include('layouts.header-content')
@include('layouts.aside')
<main id="main" class="main" style="height: 80vh">
<div class="container">
    <div class="card">
        <div class="card-header">
            <p class="text-2xl font-serif font-semibold text-center">Farmers Data Details</p>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $farmers->id }}</td>
                </tr>
                <tr>
                    <th>farmer ID</th>
                    <td>{{ $farmers->name }}</td>
                </tr>
                <tr>
                    <th>Email </th>
                    <td>{{ $farmers->email }}</td>
                </tr>
                <tr>
                    <th>District</th>
                    <td>{{ $farmers->district }}</td>
                </tr>
                <tr>
                    <th>Phone </th>
                    <td>{{ $farmers->phone }}</td>
                </tr>

                <tr>
                    <th>Created At</th>
                    <td>{{ $farmers->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $farmers->updated_at }}</td>
                </tr>
            </table>

            <div class="btn-group" role="group">


                <form action="{{ route('farmers.destroy', $farmers->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('farmers.edit', $farmers->id) }}" class="btn btn-warning">Edit</a>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?');">Delete</button>
                    <a href="{{ route('farmers.index') }}" class="btn btn-secondary">Back to List</a>
                </form>

                
            </div>
        </div>
    </div>
</div>
</main>
@include('layouts.footer')
@include('layouts.script')
