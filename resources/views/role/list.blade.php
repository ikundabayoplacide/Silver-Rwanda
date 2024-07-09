@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

@include('layouts.head-part')

<body>
@include('layouts.header-content')
  <!-- ======= Sidebar ======= -->
  @include('layouts.aside')

  <main id="main" class="main" style="height: 80vh">
@include('-message')
    <div class="pagetitle">
      <h1>ROLES</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">ROLES</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <a href="{{ route('role.add') }}" class="btn btn-success float-end">Add Role</a>
<table class="table table-striped">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">name</th>
    <th scope="col">role</th>
    <th scope="col">date</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
  @foreach ($getrecord as $value)
  <tr>
    <td scope="row">{{$value->id}}</td>
    <td>{{$value->name}}</td>
    <td>{{$value->role}}</td>
    <td>{{$value->created_at}}</td>

  <td>
    <a href="{{ url('role/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
    <a href="{{ url('role/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
  </td>
</tr>
  @endforeach
</tbody>
</table>
  </main>
@include('layouts.footer')
@include('layouts.script')

</body>

</html>
@endsection