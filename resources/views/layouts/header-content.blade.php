
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="#" class="logo d-flex align-items-center">
      <img src="/logo.jpg" alt="">
      <span class="d-none d-lg-block"> {{__('Dashboard')}}</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  {{-- <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div> --}}

<nav class="ms-auto">
    
    <ul class="navbar-nav d-flex flex-row align-items-center  gap-3 pe-4 ">
      <!-- Authentication Links -->
      @guest
        @if (Route::has('admin.login'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
          </li>
        @endif

        @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
        @endif
      @else
      
      
      <div class="d-flex align-items-center gap-4 mt-2">
        <select id="languageSelect" class="form-select" aria-label="Default select example">
          <option value="{{ route('user.lang', ['lang' => 'en']) }}" class="text-xl font-serif " {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
          <option value="{{ route('user.lang', ['lang' => 'kiny']) }}" class="text-xl font-serif" {{ app()->getLocale() == 'kiny' ? 'selected' : '' }}>Kinyarwanda</option>
        </select>
      </div>
      
      <script>
        document.getElementById('languageSelect').addEventListener('change', function() {
          var selectedValue = this.value;
          if (selectedValue) {
            window.location.href = selectedValue;
          }
        });
      </script>
      


      <li class="message">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-chat-left-text text-3xl"></i>
        </a>
      </li>
      <li class="notification">
        <a href="#">
        <i class="bi bi-bell text-3xl"></i>
      </a>
      </li>
      @role('Admin')
      <a href="#">
        <img src="/passport.jpg" alt="passport" width="50" height="50"class="rounded-circle">
       </a>
       @endrole
       @role('cooperative_manager')
       <a href="#">
         <img src="/mille.jpg" alt="sed" width="40" height="40"class="rounded-circle">
        </a>
        @endrole
        @role('sedo')
       <a href="#">
         <img src="/mille.jpg" alt="sed" width="40" height="40"class="rounded-circle">
        </a>
        @endrole
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
          </a>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('admin.login') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" style="color: green;font-size:21px">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('admin.login') }}" method="GET" class="d-none">
                  @csrf
              </form>
          </div> 
        </li>
      @endguest
    </ul>
  </nav> 
</header>

