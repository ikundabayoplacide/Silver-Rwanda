@extends('layouts.layout')

<aside id="sidebar" class="sidebar d-flex flex-column">
  <ul class="sidebar-nav flex-grow-1" id="sidebar-nav">
      <li class="nav-item">
          <a class="nav-link @if(Request::segment(2) != 'dashboard') collapsed @endif" href="{{ url('/admin/dashboard') }}">
              <i class="bi bi-grid"></i>
              <span class="font-serif text-xl">Dashboard</span>
          </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span class="font-serif text-xl">Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span class="font-serif text-xl">Alerts</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span class="font-serif text-xl">Accordion</span>
            </a>
          </li>
        
          <li>
            <a href="components-spinners.html">
              <i class="bi bi-circle"></i><span class="font-serif text-xl">Spinners</span>
            </a>
          </li>
        
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span class="font-serif text-xl">Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span class="font-serif text-xl"> Users Form </span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span class="font-serif text-xl">Form Layouts</span>
            </a>
          </li>
       
        </ul>
      </li><!-- End Forms Nav -->


      <li class="nav-item">
          <a class="nav-link @if(Request::segment(1) != 'role') collapsed @endif" href="{{ url('/role/list') }}">
            <i class="fa-brands fa-critical-role"></i>
              <span class="font-serif text-xl">Role Management</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  collapsed " href="#">
          <i class="fa-solid fa-file-invoice"></i>
            <span class="font-serif text-xl">Reporting Management</span>
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link  collapsed " href="#">
        <i class="fa-solid fa-cloud"></i>
          <span class="font-serif text-xl">Weather Data_Management</span>
      </a>
  </li>
  <li class="nav-item">
    <a class="nav-link @if (Request::segment(1)!='device_data') collapsed @endif " href="{{url('device_data')}}">
      <i class="fa-solid fa-camera-retro"></i>
        <span class="font-serif text-xl">Device Management</span>
    </a>
</li>
<li class="nav-item">
  <a class="nav-link @if (Request::segment(1)!='chart') collapsed @endif " href="{{url('/chart')}}">
    <i class="fa-solid fa-camera-retro"></i>
      <span class="font-serif text-xl">Device data Management</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link  collapsed " href="#">
    <i class="fa-regular fa-address-card"></i>
      <span class="font-serif text-xl">User Profile Management</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link  collapsed" href="#">
    <i class="fa-solid fa-user-doctor"></i>
      <span class="font-serif text-xl">User Management</span>
  </a>
</li>

  </ul>
  <div>
    <i class="fa-sharp fa-solid fa-gear"></i>
    <a href="#">
    <span class="font-serif text-xl">Settings</span>
  </div></a> <br>
  <div class="card-footer bg-transparent">
    <form action="{{ route('admin.login') }}" method="GET" id="logout-form">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    </div>
</aside><!-- End Sidebar-->

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-bsk4XhD3z+OKTprt+/+QsHgmuvMU6EM5txplnJsXxGOydaFBYDsU8U7CxrP+Ip5e" crossorigin="anonymous"></script>
