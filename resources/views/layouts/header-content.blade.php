<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        <img src="/logo.jpg" alt="">
        <span class="d-none d-lg-block"> Dashboard</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">

          <a class="nav-link nav-profile d-flex align-items-center" >
            <span>{{ auth()->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->