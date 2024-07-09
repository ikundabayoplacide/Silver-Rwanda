<!DOCTYPE html>
<html lang="en">
@include('layouts.head-part')
<body>
    @include('layouts.header-content')
    @include("layouts.sidebar-user")
    <main id="main" class="main" style="height: 80vh">
      <div class="pagetitle">
        <h1> Users Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"> Users Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

    </main>
    @include('layouts.footer-user')
    
</body>
</html>