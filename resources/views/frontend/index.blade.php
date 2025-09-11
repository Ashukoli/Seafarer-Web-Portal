{{-- resources/views/frontend/home.blade.php --}}
@extends('layouts.frontend.app')

@section('title', 'Home - Seafarer Jobs')

@push('head')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

  <style>
    /* ---------- Hot Jobs / Slider ---------- */
    .hot-jobs-section { background: #eaf8fb; padding: 18px 0 12px; }
    .hot-jobs-container { max-width: 1000px; margin: 0 auto; padding: 0 12px; }

    .jobs-carousel .carousel-item { padding: 8px 0; }

    /* Card visual update (gradient + border as requested) */
    .job-card {
      background: linear-gradient(rgba(254, 253, 250, 0.28), rgba(0, 146, 239, 0.65));
      border-radius: 14px;
      padding: 14px 16px;
      height: 200px;
      min-height: 160px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-shadow: 0 10px 22px rgba(0,0,0,0.06);
      border: 1px solid #0d73b6;
      color: #042e3c;
      overflow: hidden;
    }
    .job-card h5 {
      margin: 0 0 6px;
      font-weight: 800; /* bold title */
      color: #001f28;
      font-size: 18px;
      line-height: 1.1;
    }
    .job-meta { font-size: 13px; color: #012c33; margin-bottom:6px; }
    .job-more {
      align-self: flex-start;
      background: #fff;
      color: #0d4f57;
      border-radius: 16px;
      padding: 8px 14px;
      font-weight: 700;
      border: 1px solid rgba(0,0,0,0.06);
      box-shadow: 0 6px 14px rgba(0,0,0,0.06);
      text-decoration: none;
    }

    /* Controls row (prev/next + View all in one line) */
    .controls-line {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 16px;
      margin-top: 16px;
      flex-wrap:wrap;
    }
    .btn-arrow {
      width:44px;
      height:44px;
      border-radius:50%;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      background:#0d73b9;
      border:none;
      box-shadow: 0 8px 20px rgba(0,0,0,0.12);
      color: #fff;
      cursor: pointer;
    }
    .btn-arrow i { font-size: 18px; }
    .btn-view-all {
      background:#0d73b9;
      color:#fff;
      border-radius:6px;
      padding:10px 18px;
      font-weight:700;
      text-decoration:none;
      display:inline-block;
      box-shadow: 0 8px 20px rgba(13,115,185,0.12);
    }

    /* Reduce gaps & make cards more compact */
    .jobs-carousel .row.gx-3 { margin-left: -6px; margin-right: -6px; }
    .jobs-carousel .col-12 { padding-left: 6px; padding-right: 6px; }
    .job-card { padding-bottom:12px; } /* makes less gap between meta and button */

    /* Ensure gap between cards slightly reduced */
    .jobs-carousel .col-12.col-sm-6.col-md-3 { margin-bottom: 6px; }

    /* ---------- Featured / Reviews / Top Listed / Magazine layout ---------- */
    .two-col-below { max-width: 1000px; margin: 2px auto; display:flex; gap:6px; align-items:flex-start; padding: 0 12px; }
    .left-col { flex: 0 0 68%; }
    .right-col { flex: 0 0 32%; }

    .boxed-section {
      background:#fff;
      border:2px solid #0d73b6;
      border-radius:8px;
      padding:12px 18px;
      box-shadow: 0 10px 30px rgba(13,115,185,0.04);
      text-align: center;
    }

    .section-heading {
      text-align:center;
      margin:6px 0 20px;
      color:#0b6b74;
      font-weight:800;
      font-size:20px;
    }
    .section-divider { height:1px; background: linear-gradient(90deg, rgba(13,115,185,0.06), rgba(13,115,185,0.02)); margin:10px 0; }

    /* Featured Companies logos listing */
    .featured-logos { display:flex; flex-wrap:wrap; gap:18px; justify-content:flex-start; align-items:center; }
    .logo-tile {
      background:#fff;
      padding:12px;
      border-radius:8px;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:calc(33.333% - 12px); /* 3 per row inside featured box */
      box-shadow: 0 10px 26px rgb(0 0 0 / 40%);
      border:1px solid rgba(13,115,185,0.06);
    }
    .logo-tile img { max-width:100%; height:56px; object-fit:contain; display:block; }

    /* Top Listed Companies (grid of small logo tiles) */
    .top-listed { margin-top:18px; }
    .top-list-grid {
      display:flex;
      flex-wrap:wrap;
      gap:12px;
      justify-content:flex-start;
      align-items:center;
    }
    .top-logo {
      background:#fff;
      padding:10px;
      border-radius:6px;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:calc(20% - 10px); /* 5 per row */
      box-shadow: 0 10px 20px rgb(0 0 0 / 40%); /* keep shadow */
      border:1px solid rgba(13,115,185,0.05);
    }
    .top-logo img { max-width:100%; height:44px; object-fit:contain; display:block; }

    /* Candidate Reviews + Magazine */
    .reviews-box { margin-bottom: 18px; text-align:left; }
    .reviews-star { color:#f6a623; font-size:20px; margin-bottom:8px; display:inline-block; }
    .reviews-text { color:#0d4f57; font-size:14px; }

    /* Review carousel — small tweaks */
    .review-carousel .carousel-item { padding: 8px 0; }
    .review-item { min-height: 110px; }
    .review-item p { margin: 6px 0; color:#0d4f57; }
    .review-author { margin-top:8px; font-weight:700; color:#0b6b74; }

    .magazine-box img { width:100%; height:auto; display:block; border-radius:6px; }

    /* ---------- Listed Companies (bottom) ---------- */
    .listed-section { max-width: 1000px; margin: 18px auto 40px; padding: 0 12px; }
    .listed-box { background:#fff; border:2px solid #0d73b6; border-radius:8px; padding:14px;text-align: center;box-shadow: 0 18px 40px rgba(13,115,185,0.04); }
    .listed-title { text-align:center; font-weight:800; color:#0b6b74; margin-bottom:12px; font-size:20px; }
    .listed-grid {
      display:flex;
      flex-wrap:wrap;
      gap:16px;
      justify-content:flex-start;
      align-items:center;
    }
    .listed-item {
      flex: 1 0 calc(20% - 13px); /* 5 across on desktop */
      max-width: calc(20% - 13px);
      background:#fff;
      padding:10px;
      border-radius:6px;
      display:flex;
      align-items:center;
      justify-content:center;
      box-shadow:0 6px 18px rgb(0 0 0 / 40%);
      border:1px solid rgba(0,0,0,0.04);
    }
    .listed-item img {
      max-width: 100%;
      height: 46px;
      object-fit: contain;
      display: block;
    }

    /* ---------- Section Headings Modern Underline ---------- */
    .section-heading {
    text-align:center;
    margin:6px 0 6px;
    color:#0b6b74;
    font-weight:800;
    font-size:20px;
    position:relative;
    display:inline-block;
    padding-bottom:6px;
    }

    .section-heading::after {
    content:"";
    position:absolute;
    left:50%;
    bottom:0;
    transform:translateX(-50%);
    width:50%;                 /* underline width */
    height:5px;                 /* underline thickness */
    background: linear-gradient(90deg, #0d73b9, #09a6d4); /* modern gradient */
    border-radius:2px;
    }

    /* ---------- Responsive rules ---------- */
    @media (max-width: 991px) {
      .two-col-below { flex-direction:column; gap:14px; max-width: 920px; }
      .left-col, .right-col { flex: 1 0 100%; }
      .logo-tile { width: calc(33.333% - 12px); }
      .top-logo { width: calc(25% - 9px); } /* 4 per row on tablet */
      .listed-item { flex: 1 0 calc(25% - 12px); max-width: calc(25% - 12px); } /* 4 per row */
    }

    @media (max-width: 720px) {
      .logo-tile { width: calc(50% - 12px); } /* make featured logos 2 per row on small screens */
      .top-logo { width: calc(33.333% - 9px); } /* 3 per row */
      .listed-item { flex: 1 0 calc(33.333% - 10px); max-width: calc(33.333% - 10px); } /* 3 per row */
    }

    @media (max-width: 480px) {
      .listed-item { flex: 1 0 calc(50% - 10px); max-width: calc(50% - 10px); } /* 2 per row mobile */
      .job-card { height: auto; min-height: 180px; }
    }

    /* ---------- Mobile: show only one card per carousel-item (fix) ---------- */
    @media (max-width: 767px) {
      /* Hide all columns in each carousel-item except the first child so the slide effectively shows 1 card */
      #jobsCarousel .carousel-item .col-12.col-sm-6.col-md-3 { display: none; }
      #jobsCarousel .carousel-item .col-12.col-sm-6.col-md-3:first-child { display: block; width:100%; }
      .job-card { margin-bottom:12px; }
      .controls-line { margin-top: 10px; }
    }

  </style>
@endpush

@section('content')
  {{-- HOT JOBS SLIDER --}}
  <section class="hot-jobs-section" aria-label="Hot jobs slider area">
    <div class="hot-jobs-container" data-aos="fade-up">

      <div id="jobsCarousel" class="carousel slide jobs-carousel" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">

          {{-- Slide 1 --}}
          <div class="carousel-item active">
            <div class="row gx-3">
              <div class="col-12 col-sm-6 col-md-3">
                <article class="job-card" aria-label="Required Chief Off for VLGC">
                  <div>
                    <h5>Required Chief Off for VLGC</h5>
                    <div class="job-meta">
                      <div><strong>Joining Date:</strong> 2025-09-13</div>
                      <div><strong>Nationality:</strong> Indian</div>
                      <div><strong>Minimum Exp:</strong> 6 Months</div>
                    </div>
                  </div>
                  <a class="job-more" href="#" aria-label="More details">More</a>
                </article>
              </div>

              <div class="col-12 col-sm-6 col-md-3">
                <article class="job-card">
                  <div>
                    <h5>Required 2nd Engr. for Bulk Carrier</h5>
                    <div class="job-meta">
                      <div><strong>Joining Date:</strong> 2025-09-15</div>
                      <div><strong>Nationality:</strong> Indian</div>
                      <div><strong>Minimum Exp:</strong> 1 Year</div>
                    </div>
                  </div>
                  <a class="job-more" href="#">More</a>
                </article>
              </div>

              <div class="col-12 col-sm-6 col-md-3">
                <article class="job-card">
                  <div>
                    <h5>Required Chief Off for Bulk Carrier</h5>
                    <div class="job-meta">
                      <div><strong>Joining Date:</strong> 2025-09-12</div>
                      <div><strong>Nationality:</strong> Indian</div>
                      <div><strong>Minimum Exp:</strong> 12 Months</div>
                    </div>
                  </div>
                  <a class="job-more" href="#">More</a>
                </article>
              </div>

              <div class="col-12 col-sm-6 col-md-3">
                <article class="job-card">
                  <div>
                    <h5>Required Chief Engr. for Bulk Carrier</h5>
                    <div class="job-meta">
                      <div><strong>Joining Date:</strong> 2025-09-12</div>
                      <div><strong>Nationality:</strong> Indian</div>
                      <div><strong>Minimum Exp:</strong> 12 Months</div>
                    </div>
                  </div>
                  <a class="job-more" href="#">More</a>
                </article>
              </div>
            </div>
          </div>

          {{-- Slide 2 --}}
          <div class="carousel-item">
            <div class="row gx-3">
              <div class="col-12 col-sm-6 col-md-3">
                <article class="job-card">
                  <div>
                    <h5>Electrical Officer for Tanker</h5>
                    <div class="job-meta">
                      <div><strong>Joining Date:</strong> 2025-09-20</div>
                      <div><strong>Nationality:</strong> Indian</div>
                      <div><strong>Minimum Exp:</strong> 24 Months</div>
                    </div>
                  </div>
                  <a class="job-more" href="#">More</a>
                </article>
              </div>

              <div class="col-12 col-sm-6 col-md-3">
                <article class="job-card">
                  <div>
                    <h5>3rd Officer for VLCC</h5>
                    <div class="job-meta">
                      <div><strong>Joining Date:</strong> 2025-09-18</div>
                      <div><strong>Nationality:</strong> Indian</div>
                      <div><strong>Minimum Exp:</strong> 18 Months</div>
                    </div>
                  </div>
                  <a class="job-more" href="#">More</a>
                </article>
              </div>

              <div class="col-12 col-sm-6 col-md-3">
                <article class="job-card">
                  <div>
                    <h5>Chief Engineer for Container</h5>
                    <div class="job-meta">
                      <div><strong>Joining Date:</strong> 2025-09-25</div>
                      <div><strong>Nationality:</strong> Indian</div>
                      <div><strong>Minimum Exp:</strong> 36 Months</div>
                    </div>
                  </div>
                  <a class="job-more" href="#">More</a>
                </article>
              </div>

              <div class="col-12 col-sm-6 col-md-3">
                <article class="job-card">
                  <div>
                    <h5>Deck Cadet for Bulk Carrier</h5>
                    <div class="job-meta">
                      <div><strong>Joining Date:</strong> 2025-09-22</div>
                      <div><strong>Nationality:</strong> Indian</div>
                      <div><strong>Minimum Exp:</strong> 0 Months</div>
                    </div>
                  </div>
                  <a class="job-more" href="#">More</a>
                </article>
              </div>
            </div>
          </div>

        </div>
      </div>

      {{-- Controls (prev/next + view all) on same line --}}
      <div class="controls-line" aria-hidden="false" role="group" aria-label="Hot jobs controls">
        <button class="btn-arrow" type="button" data-bs-target="#jobsCarousel" data-bs-slide="prev" aria-label="Previous">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </button>

        <button class="btn-arrow" type="button" data-bs-target="#jobsCarousel" data-bs-slide="next" aria-label="Next">
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </button>

        <a href="{{ route('hotjobs.index') }}" class="btn-view-all" aria-label="View all hot jobs">View All Hot Jobs</a>
      </div>

    </div>
  </section>

  {{-- BELOW: Featured / Reviews / Top Listed / Magazine --}}
  <div class="two-col-below" data-aos="fade-up">
    <div class="left-col">

      {{-- Featured Companies --}}
      <div class="boxed-section">
        <h3 class="section-heading">Featured Companies</h3>
        <div class="featured-logos">
          {{-- Use provided banner images for featured companies --}}
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/462.jpg" alt="Company 462"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/409.png" alt="Company 409"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/380.png" alt="Company 380"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/445.jpeg" alt="Company 445"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/437.png" alt="Company 437"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/458.jpg" alt="Company 458"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/462.jpg" alt="Company 462"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/409.png" alt="Company 409"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/380.png" alt="Company 380"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/445.jpeg" alt="Company 445"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/437.png" alt="Company 437"></div>
          <div class="logo-tile"><img src="https://seafarerjobs.com/homebanner_image/458.jpg" alt="Company 458"></div>
        </div>
      </div>

      {{-- Top Listed Companies (below featured) --}}
      <div class="boxed-section top-listed" style="margin-top:18px;">
        <h3 class="section-heading">Top Listed Companies</h3>
        <div class="top-list-grid">
          {{-- replicate several smaller tiles (4 per row on larger screens) --}}
          <div class="top-logo"><img src="https://seafarerjobs.com/homebanner_image/462.jpg" alt="Top 1"></div>
          <div class="top-logo"><img src="https://seafarerjobs.com/homebanner_image/409.png" alt="Top 2"></div>
          <div class="top-logo"><img src="https://seafarerjobs.com/homebanner_image/380.png" alt="Top 3"></div>
          <div class="top-logo"><img src="https://seafarerjobs.com/homebanner_image/445.jpeg" alt="Top 4"></div>
          <div class="top-logo"><img src="https://seafarerjobs.com/homebanner_image/437.png" alt="Top 5"></div>
          <div class="top-logo"><img src="https://seafarerjobs.com/homebanner_image/458.jpg" alt="Top 6"></div>
          <div class="top-logo"><img src="https://seafarerjobs.com/homebanner_image/462.jpg" alt="Top 7"></div>
          <div class="top-logo"><img src="https://seafarerjobs.com/homebanner_image/409.png" alt="Top 8"></div>
          <div class="top-logo"><img src="https://seafarerjobs.com/homebanner_image/380.png" alt="Top 9"></div>
          <div class="top-logo"><img src="https://seafarerjobs.com/homebanner_image/445.jpeg" alt="Top 10"></div>
        </div>
      </div>

    </div>

    <div class="right-col">
      {{-- Candidate Reviews (carousel) --}}
      <div class="boxed-section reviews-box">
        <h3 class="section-heading">Candidate Reviews</h3>

        <div id="reviewsCarousel" class="carousel slide review-carousel" data-bs-ride="carousel" data-bs-interval="5000">
          <div class="carousel-inner">

            <div class="carousel-item active">
              <div class="review-item">
                <div class="reviews-star">★★★★★</div>
                <p class="reviews-text">Good source for seafarer jobs and reliable database.</p>
                <div class="review-author">- RAHUL M, (CH. OFF.)</div>
              </div>
            </div>

            <div class="carousel-item">
              <div class="review-item">
                <div class="reviews-star">★★★★★</div>
                <p class="reviews-text">Very helpful when I was searching for a position, quick responses from recruiters.</p>
                <div class="review-author">- VIVEK G, (4TH ENGR.)</div>
              </div>
            </div>

            <div class="carousel-item">
              <div class="review-item">
                <div class="reviews-star">★★★★☆</div>
                <p class="reviews-text">Found an interview lead within a week. Good platform.</p>
                <div class="review-author">- ANITA P, (DECK)</div>
              </div>
            </div>

            <div class="carousel-item">
              <div class="review-item">
                <div class="reviews-star">★★★★★</div>
                <p class="reviews-text">Great database and responsive support.</p>
                <div class="review-author">- REXMOTHA RAIMOTHA, (MOTORMAN/OILER)</div>
              </div>
            </div>

          </div>

          {{-- small controls --}}
          <div class="mt-3" style="display:flex; gap:8px; align-items:center;">
            <button class="btn-arrow" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="prev" aria-label="Previous review"><i class="fa fa-chevron-left"></i></button>
            <button class="btn-arrow" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="next" aria-label="Next review"><i class="fa fa-chevron-right"></i></button>
            <a class="btn-view-all" href="{{ route('reviews') }}" style="padding:8px 12px; font-size:14px;">Read all</a>
          </div>

        </div>
      </div>

      {{-- TMWS Magazine (separate box, not combined with reviews) --}}
      <div class="boxed-section magazine-box" style="margin-top:14px;">
        <h3 class="section-heading">TMWS (Fortnightly Magazine)</h3>

        <img src="https://www.seafarerjobs.com/frontimage.jpg" alt="TMWS Magazine">
      </div>
    </div>
  </div>

  {{-- LISTED COMPANIES (BOTTOM) --}}
  <div class="listed-section" data-aos="fade-up">
    <div class="listed-box">
      <h3 class="section-heading">Listed Companies</h3>

      <div class="listed-grid">
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/462.jpg" alt="L1"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/409.png" alt="L2"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/380.png" alt="L3"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/445.jpeg" alt="L4"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/437.png" alt="L5"></div>

        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/458.jpg" alt="L6"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/462.jpg" alt="L7"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/409.png" alt="L8"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/380.png" alt="L9"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/445.jpeg" alt="L10"></div>

        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/437.png" alt="L11"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/458.jpg" alt="L12"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/462.jpg" alt="L13"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/409.png" alt="L14"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/380.png" alt="L15"></div>

        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/445.jpeg" alt="L16"></div>
        <div class="listed-item"><img src="https://seafarerjobs.com/homebanner_image/437.png" alt="L17"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (window.AOS) AOS.init({ once: true, duration: 700, easing: 'ease-in-out' });

      // optional: equalize heights for desktop so the 4 cards look consistent
      function equalizeHeights(){
        const cards = document.querySelectorAll('#jobsCarousel .carousel-item.active .job-card, #jobsCarousel .carousel-item:not(.active) .job-card');
        if (!cards.length) return;
        cards.forEach(c => c.style.height = '');
        if (window.innerWidth >= 768) {
          let maxH = 0;
          cards.forEach(c => {
            const h = c.getBoundingClientRect().height;
            if (h > maxH) maxH = h;
          });
          cards.forEach(c => c.style.height = maxH + 'px');
        }
      }
      equalizeHeights();
      window.addEventListener('resize', function(){ setTimeout(equalizeHeights, 120); });

    });
  </script>
@endpush
