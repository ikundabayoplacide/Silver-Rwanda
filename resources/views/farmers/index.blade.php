
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>farmers Data List</h2>
    <a href="{{ route('farmers.register') }}" class="btn btn-success mb-3">Create New farmers Datails</a>

    @if ($farmers->isEmpty())
        <p>No farmers data found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Farmer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>District </th>
                    <th>Actions</th>
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
                            <a href="{{ route('farmers.show', ['farmers' => $farmer->id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('farmers.edit', ['farmers' => $farmer->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('farmers.destroy', ['farmers' => $farmer->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this device data?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
