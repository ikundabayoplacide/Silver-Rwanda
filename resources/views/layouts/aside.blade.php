@extends('layouts.layout')

<aside id="sidebar" class="sidebar d-flex flex-column">
  <ul class="sidebar-nav flex-grow-1" id="sidebar-nav">
      <li class="nav-item">
          <a class="nav-link @if(Request::segment(2) != 'dashboard') collapsed @endif" href="{{ url('/admin/dashboard') }}">
              <i class="bi bi-grid"></i>
              <span class="font-serif text-xl">{{__('Dashboard')}}</span>
          </a>
      </li><!-- End Dashboard Nav -->

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span class="font-serif text-xl">Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span class="font-serif text-xl">Alerts</span>
            </a>
          </li>


        </ul>
      </li><!-- End Components Nav --> --}}

      {{-- <li class="nav-item">
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
      </li><!-- End Forms Nav --> --}}
  @role('Admin')
      <li class="nav-item">
          <a class="nav-link @if(Request::segment(1) != 'roles') collapsed @endif" href="{{ route('roles.index') }}">
            <i class="fa-brands fa-critical-role"></i>
              <span class="font-serif text-xl">{{__('Role Management')}}</span>
          </a>
      </li>
      @endrole
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="fa-solid fa-file-invoice"></i>
            <span class="font-serif text-xl">{{__('Reporting Management')}}</span>
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#">
        <i class="fa-solid fa-cloud"></i>
          <span class="font-serif text-xl">{{__('Weather Data Management')}}</span>
      </a>
  </li>
  <li class="nav-item">
    <a class="nav-link @if (Request::segment(1) != 'device_data') collapsed @endif" href="{{url('device_data')}}">
      <i class="fa-solid fa-camera-retro"></i>
        <span class="font-serif text-xl">{{__('Device Management')}}</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link @if (Request::segment(1) != 'tabular') collapsed @endif" href="{{url('tabular')}}">
      <i class="fa-solid fa-camera-retro"></i>
        <span class="font-serif text-xl">{{__('Visualization of Data')}}</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link @if (Request::segment(1) != 'farmers') collapsed @endif" href="{{url('farmers/index')}}">
      <i class="fa-solid fa-camera-retro"></i>
        <span class="font-serif text-xl">{{__('Farmer Management')}}</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#">
      <i class="fa-regular fa-address-card"></i>
        <span class="font-serif text-xl">{{__('User Profile Management')}}</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#cooperative-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span class="font-serif text-xl">{{__('Cooperative Management')}}</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="cooperative-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a class="nav-link @if (Request::segment(1) != 'cooperative') collapsed @endif" href="{{url('cooperatives')}}">
          <i class="bi bi-circle"></i><span class="font-serif text-xl">{{__('Cooperative Management')}}</span>
        </a>
      </li>
      <li>
        <a class="nav-link @if (Request::segment(1) != 'assign') collapsed @endif" href="{{url('/assign')}}">
          <i class="bi bi-circle"></i><span class="font-serif text-xl">{{__('Assign Farmer to Cooperative')}}</span>
        </a>
      </li>
    </ul>
  </li>


  <li class="nav-item">
    <a class="nav-link @if (Request::segment(1) != 'users') collapsed @endif" href="{{ route('users.index') }}">
      <i class="fa-solid fa-user-doctor"></i>
        <span class="font-serif text-xl">{{__('User Management')}}</span>
    </a>
  </li>
  @role('naeb')
  <li class="nav-item">
    <a class="nav-link @if (Request::segment(1) != 'role') collapsed @endif" href="#">
      <i class="bi bi-envelope"></i>
      <span>{{__('National level Management')}}</span>
    </a>
  </li>
  @endrole
  </ul>
  <div class="ml-4">
    <i class="fa-sharp fa-solid fa-gear"></i>
    <a href="#">
      <span class="font-serif text-2xl ">{{__('Settings')}}</span>
    </a>
  </div>
</aside><!-- End Sidebar -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-bsk4XhD3z+OKTprt+/+QsHgmuvMU6EM5txplnJsXxGOydaFBYDsU8U7CxrP+Ip5e" crossorigin="anonymous"></script>
