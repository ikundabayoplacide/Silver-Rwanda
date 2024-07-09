
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
        <h1>Add new Role</h1>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Horizontal Form</h5>
  
                <!-- Horizontal Form -->
                <form method="POST" action="{{url(route('role.store'))}}">
                    @csrf
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Your Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" required id="inputText">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Role lever</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="role" required id="inputText">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                </form><!-- End Horizontal Form -->
  
              </div>
            </div>
          </div>  
        </div>
      </section>
  </main>
@include('layouts.footer')
@include('layouts.script')
</body>

</html>
@endsection