@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>farmers Data Details</h2>
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
                    <td>{{ $farmers->Phone }}</td>
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
                <a href="{{ route('farmers.edit', $farmers->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('farmers.destroy', $farmers->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?');">Delete</button>
                </form>

                <a href="{{ route('farmers.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
