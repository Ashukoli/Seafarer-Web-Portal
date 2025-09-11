<!-- Top Header -->
<div class="top-header">
  <div class="container d-flex justify-content-between align-items-center flex-wrap">
    <!-- Logo -->
    <div class="site-logo d-flex align-items-center mb-2 mb-md-0">
      <img src="https://seafarerjobs.com/seafarerjobs.com.png" alt="Seafarer Jobs Logo">
    </div>

    <!-- Right section: Social + Login -->
    <div class="d-flex align-items-center flex-wrap justify-content-center">
      <div class="social-icons me-3">
        <a href="#"><i class="fab fa-facebook-square"></i></a>
        <a href="#"><i class="fab fa-linkedin"></i></a>
        <a href="#"><i class="fab fa-twitter-square"></i></a>
      </div>
      <div class="login-buttons">
        <a href="{{ route('candidate.login') }}" class="login-btn">Candidate Login</a>
        <a href="{{ route('company.login') }}" class="login-btn">Company Login</a>
     </div>
    </div>
  </div>
</div>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg nav-bar">
  <div class="container">
    <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="mainNav">
      <ul class="navbar-nav flex-wrap">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('advertise') }}">Advertise</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Search Jobs</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Maritime Institutes</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Post Resume</a></li>
        <li class="nav-item"><a class="nav-link" href="#">View Resumes</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>

      </ul>
    </div>
  </div>
</nav>
