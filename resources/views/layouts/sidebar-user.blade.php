@extends('layouts.layout')

<aside id="sidebar" class="sidebar d-flex flex-column">

  <ul class="sidebar-nav flex-grow-1" id="sidebar-nav">
{{-- Self farmer Components --}}
   @role('self-farmer')
      <li class="nav-item">
          <a class="nav-link @if(Request::segment(2) !='dashboard')collapsed @endif " href="{{url('users/dashboard')}}">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Device Management</span><i class="fa-sharp fa-solid fa-sensor-on"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span>Camera</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Senser</span>
            </a>
          </li>

        </ul>
      </li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#">
            <i class="fa-sharp fa-solid fa-tachograph-digital"></i>
              <span>Device Data Management</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="fa-sharp fa-solid fa-cloud"></i>
            <span>Weather Data Management</span>
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#">
        <i class="fa-sharp fa-solid fa-shower"></i>
          <span>Irrigation scheduling Management</span>
      </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#">
      <i class="fa-sharp fa-solid fa-file-invoice"></i>
        <span> Reporting Management</span>
    </a>
</li>
    @endrole


    {{-- Cooperative manager components --}}
    @role( 'cooperative_manager')
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='dashboard')collapsed @endif " href="{{url('users/dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
      </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Device Management</span><i class="fa-sharp fa-solid fa-sensor-on"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="components-alerts.html">
          <i class="bi bi-circle"></i><span>Camera</span>
        </a>
      </li>
      <li>
        <a href="components-accordion.html">
          <i class="bi bi-circle"></i><span>Senser</span>
        </a>
      </li>

    </ul>
  </li>

  <li class="nav-item">
      <a class="nav-link collapsed" href="#">
        <i class="fa-sharp fa-solid fa-tachograph-digital"></i>
          <span>Device Data Management</span>
      </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#">
      <i class="fa-sharp fa-solid fa-cloud"></i>
        <span>Weather Data Management</span>
    </a>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="#">
    <i class="fa-sharp fa-solid fa-shower"></i>
      <span>Irrigation scheduling Management</span>
  </a>
</li>


<li class="nav-item">
  <a class="nav-link collapsed" href="#">
    <i class="fa-sharp fa-solid fa-people-roof"></i>
      <span> Farmers Management</span>
  </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#">
      <i class="fa-sharp fa-solid fa-camera"></i>
        <span> Assigning Device to Farmer</span>
    </a>
    </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#">
      <i class="fa-sharp fa-solid fa-user"></i>
        <span> User Profile Management</span>
    </a>
    </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="fa-sharp fa-solid fa-file-invoice"></i>
            <span> Reporting Management</span>
        </a>
        </li>

  @endrole

    {{-- Sedo components --}}
      @role('sedo')
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-grid"></i>
            <span> Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#">
        <i class="fa-sharp fa-solid fa-cloud"></i>
          <span> Weather Data Management</span>
      </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#">
      <i class="fa-sharp fa-solid fa-tachograph-digital"></i>
        <span> Device Data Management</span>
    </a>
</li>
<li class="nav-item">
  <a class="nav-link @if (Request::segment('1')!='cooperatives') @endif collapsed" href="{{url('cooperatives')}}">
    <i class="fa-solid fa-people-group"></i>
      <span> Cooperative Management</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="#">
    <i class="fa-sharp fa-solid fa-file-invoice"></i>
      <span> Reporting Management</span>
  </a>
</li>
    @endrole


    {{-- Sector components --}}
    @role( 'sector_agronome')
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) !='role')collapsed @endif" href="#">
            <i class="bi bi-envelope"></i>
            <span> Sector Management</span>
        </a>
    </li>
    @endrole

  {{-- District manager components --}}
  @role( 'district_agronome')
  <li class="nav-item">
    <a class="nav-link @if(Request::segment(1) !='role')collapsed @endif" href="#">
        <i class="bi bi-envelope"></i>
        <span>District Management</span>
    </a>
</li>
@endrole
{{-- NAEB components --}}

@role( 'naeb')
<li class="nav-item">
  <a class="nav-link @if(Request::segment(1) !='role')collapsed @endif" href="#">
      <i class="bi bi-envelope"></i>
      <span>National level Management</span>
  </a>
</li>
@endrole


<li class="nav-item">
  <a class="nav-link collapsed" href="#">
    <i class="fa-sharp fa-solid fa-tachograph-digital"></i>
      <span> Device Data Management</span>
  </a>
</li>
<li class="nav-item">

  <a class="nav-link collapsed" href="#">
    <i class="fa-sharp fa-solid fa-tachograph-digital"></i>
      <span> Farmers Data Management</span>
  </a>
</li>

  </ul>

  <div>
    <i class="fa-sharp fa-solid fa-gear"></i>
    <a href="#">
    <span class="font-serif text-xl">Settings</span>
  </div></a> <br>
  <div class="card-footer bg-transparent">
    <form action="{{ route('user.logout') }}" method="POST" id="logout-form">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
    </form>

  </div>
</aside><!-- End Sidebar-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-bsk4XhD3z+OKTprt+/+QsHgmuvMU6EM5txplnJsXxGOydaFBYDsU8U7CxrP+Ip5e" crossorigin="anonymous"></script>
