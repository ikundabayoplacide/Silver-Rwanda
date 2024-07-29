@extends('layouts.layout');
@section('content')
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <img src="/logo.jpg" alt="logo" width="100" height="80" style="border-radius: 6px">
          <div class="navbar-collapse">
            <ul class="navbar-nav me-auto mb-lg-0">
              <li class="nav-item">
                <a class="nav-link text-3xl " href="/home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-3xl" href="#">Image</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-3xl" href="#">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-3xl" href="#">Team</a>
              </li>

              <li class="nav-item">
                <a class="nav-link text-3xl" href="#">Services</a>
              </li>
            </ul>

            <form class="d-flex">
                <div class="registration">
                  <button class="btn btn-success "><a href="{{ url('/login') }}">Login</a></button>
                  <button class="btn btn-success "><a href="{{ url('/register') }}"> Register</a></button>
                </div>
            </form>
          </div>
        </div>
      </nav>
