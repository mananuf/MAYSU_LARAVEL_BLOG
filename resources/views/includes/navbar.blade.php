<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
  <a href="{{url('/')}}" class="navbar-brand ms-4 ms-lg-0">
      <h1 class="text-primary m-0"><img class="me-3" src="{{asset('img/icons/icon-1.png')}}" alt="Icon">MAYSU</h1>
  </a>
  <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto p-4 p-lg-0">
          <a href="{{url('/')}}" class="nav-item nav-link active">Home</a>
          <a href="{{url('/about')}}" class="nav-item nav-link">About</a>
          <a href="{{url('/services')}}" class="nav-item nav-link">Services</a>
          <a href="{{url('/contact')}}" class="nav-item nav-link">Contact</a>
          <a href="{{url('/posts')}}" class="btn btn-primary py-2 px-4 d-lg-none">Blog</a>
      </div>
      <a href="{{url('/posts')}}" class="btn btn-primary py-2 px-4 d-none d-lg-block">Blog</a>
  </div>
</nav>
<!-- Navbar End -->