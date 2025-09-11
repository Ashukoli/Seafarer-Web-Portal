{{-- resources/views/frontend/about.blade.php --}}
@extends('layouts.frontend.app')

@section('title', 'About Us - Seafarer Jobs')

@push('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
<style>
  /* HERO section */
  .about-hero {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;
    margin-bottom: 40px;
    flex-wrap: wrap;
  }
  .about-hero .hero-text {
    flex: 1 1 55%;
    max-width: 55%;
  }
  .about-hero .hero-text h1 { margin-bottom: 15px; }
  .about-hero .hero-image {
    flex: 1 1 40%;
    max-width: 40%;
  }
  .about-hero .hero-image img {
    width: 100%;
    border-radius: 8px;
    object-fit: cover;
  }

  /* Two-column layout */
  .two-col {
    display: flex;
    gap: 30px;
    align-items: flex-start;
  }
  .two-col .main { flex: 0 0 65%; max-width: 65%; }
  .two-col .aside { flex: 0 0 33%; max-width: 35%; }

  /* Aside cards */
  .aside .section-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.05);
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  }
  .aside .section-card img {
    width: 100%;
    max-height: 200px;
    object-fit: cover;
    border-radius: 6px;
    margin-bottom: 12px;
  }

  /* Lists inside services */
  .about-page .section-card ul {
    padding-left: 0;
    list-style: none;
    margin-top: 12px;
  }
  .about-page .section-card ul li {
    margin-bottom: 12px;
  }

  /* Responsive */
  @media (max-width: 992px) {
    .about-hero .hero-text, .about-hero .hero-image {
      flex: 1 1 100%;
      max-width: 100%;
    }
    .two-col { flex-direction: column; }
    .two-col .main, .two-col .aside {
      flex: 1 1 100%;
      max-width: 100%;
    }
  }
</style>
@endpush

@section('content')
<div class="about-page">
  <div class="container py-5">

    {{-- HERO --}}
    <div class="about-hero" data-aos="fade-up">
      <div class="hero-text">
        <h1>About Us</h1>
        <p class="lead">
          Seafarerjobs.com is an online job portal in the marine sector of the shipping industry.
          This platform provides a focused, user-friendly connection point for candidates and employers.
        </p>
      </div>
      <div class="hero-image">
        <img src="{{ asset('frontend/assets/images/frontend/about-hero.png') }}" alt="Container ship at sea">
      </div>
    </div>

    {{-- MAIN + ASIDE --}}
    <div class="two-col">
      <div class="main">
        {{-- What we do --}}
        <section class="section-card" data-aos="fade-right">
          <h3>What we do?</h3>
          <p>
            Seafarerjobs.com is an online job portal in the marine sector of the shipping industry.
            This online platform offers a focused, user-friendly connection point for candidates and employers.
          </p>
        </section>

        {{-- Why --}}
        <section class="section-card" data-aos="fade-left">
          <h3>Why Seafarerjobs.com?</h3>
          <p>
            As a service of our seafarer database management system, Seafarerjobs.com is structured uniquely to align recruiters' and
            candidates' interests. Seafarerjobs.com garners quality seafarer resumes, assisting you to find top talent in the shipping industry.
          </p>
        </section>

        {{-- Services --}}
        <section class="section-card" data-aos="fade-up">
          <h3>Our Services</h3>

          <h5>Database Access Solutions</h5>
          <ul>
            <li><i class="fa fa-database text-primary me-2"></i> Access our validated seafarer database</li>
            <li><i class="fa fa-tasks text-primary me-2"></i> Personalized Admin Dashboard</li>
            <li><i class="fa fa-rocket text-primary me-2"></i> Seafarer Express Services</li>
          </ul>

          <h5 class="mt-3">Branding Solutions</h5>
          <ul>
            <li><i class="fa fa-bullhorn text-primary me-2"></i> Advertising & Featured Listings</li>
            <li><i class="fa fa-newspaper text-primary me-2"></i> Print Magazine — The Modern World Seafarer's</li>
          </ul>
        </section>

        {{-- Vision & Values --}}
        <section class="section-card" data-aos="fade-up">
          <h3>Our Vision</h3>
          <p>
            To bridge the gap between seafarers & shipping companies by offering a user-friendly and focused connecting point,
            thus fulfilling our mantra.
          </p>

          <h3 class="mt-3">Our Values</h3>
          <ul>
            <li><strong>Customer Commitment:</strong> We develop relationships that make a positive difference in our customers' lives.</li>
            <li><strong>Quality:</strong> We provide outstanding products and unsurpassed service that deliver premium value.</li>
            <li><strong>Integrity:</strong> We uphold the highest standards of integrity in all of our actions.</li>
            <li><strong>Teamwork:</strong> We work together, across boundaries to meet the needs of our customers.</li>
            <li><strong>Respect for people:</strong> We value our people, encourage their development and reward their performance.</li>
            <li><strong>A Will To Win:</strong> We exhibit a strong will to win in the marketplace and in every aspect of our business.</li>
          </ul>
        </section>
      </div>

      {{-- ASIDE --}}
      <aside class="aside">
        <div class="section-card" data-aos="fade-left">
          <img src="{{ asset('frontend/assets/images/frontend/about-team.png') }}" alt="Recruitment team at work">
          <h5>Trusted Maritime Talent</h5>
          <p class="small text-muted">
            We verify candidate credentials and maintain a quality-first database to make your hiring effective and compliant.
          </p>
        </div>

        <div class="section-card" data-aos="fade-left" data-aos-delay="100">
          <h5>Our Networks</h5>
          <p>
            <a href="https://www.seafarerjobs.com" target="_blank">www.seafarerjobs.com</a><br>
            <a href="https://www.marineinstitutes.com" target="_blank">www.marineinstitutes.com</a><br>
            <a href="https://www.onlinefreightsolutions.com" target="_blank">www.onlinefreightsolutions.com</a>
          </p>
          <p><strong>Print Media:</strong> The Modern World Seafarers (TMWS)</p>
        </div>
      </aside>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>AOS.init({ once: true, duration: 700, easing: 'ease-in-out' });</script>
@endpush
