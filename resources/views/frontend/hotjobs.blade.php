{{-- resources/views/frontend/hotjobs.blade.php --}}
@extends('layouts.frontend.app')

@section('title', 'All Hot Jobs - Seafarer Jobs')

@push('head')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

  <style>
    /* Defensive global box-sizing and font-smoothing */
    *, *::before, *::after { box-sizing: border-box; }
    html, body { -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale; }

    /* Prevent page horizontal scroll globally */
    html, body { overflow-x: hidden; }

    /* ---------- Outer wrapper (boxed layout) ---------- */
    .hotjobs-page { background: #f4f6f9; padding: 0 0 60px; }
    .hotjobs-wrap {
      width: 100%;
      max-width: 1000px;                 /* boxed width */
      margin: 0 auto !important;         /* keep centered */
      position: relative;
      overflow: hidden;                  /* clip accidental overflow */
    }

    /* visual content box inside the wrapper */
    .hotjobs-box {
      background: #ffffff;
      border: 1px solid rgb(106 129 145 / 30%);
      padding: 28px;
      box-shadow: 0 18px 50px rgba(10,20,40,0.08);
      width: 100%;
      overflow: hidden;                  /* important to prevent overflow */
    }

    /* Page title */
    .page-title {
      text-align: center;
      color: #0b6b74;
      font-weight: 900;
      font-size: 30px;
      margin: 0 0 6px;
      position: relative;
      padding-bottom: 8px;
    }
    .page-title::after{
      content: "";
      display:block;
      height:5px;
      width:90px;
      margin:8px auto 0;
      background: linear-gradient(90deg,#0d73b9,#09a6d4);
      border-radius:3px;
    }

    /* ---------- Jobs grid ---------- */
    .jobs-grid {
      margin-top: 26px;
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr)); /* minmax(0,1fr) prevents overflow */
      gap: 18px;
      width: 100%;
      align-items: start;
    }

    /* ensure grid children cannot force parent to expand */
    .jobs-grid > * { min-width: 0; }

    @media (max-width: 992px) {
      .jobs-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 576px) {
      .jobs-grid { grid-template-columns: 1fr; gap: 14px; }
    }

    /* ---------- Job card ---------- */
    .job-card {
      background: linear-gradient(rgba(254,253,250,0.28), rgba(0,146,239,0.65));
      border-radius: 12px;
      border: 1px solid #0d73b6;
      box-shadow: 0 10px 26px rgba(13,115,185,0.06);
      padding: 12px 14px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 130px;        /* reduced height */
      max-height: 210px;
      overflow: hidden;
      color: #022f35;
      word-wrap: break-word;
      word-break: break-word;
    }

    .job-card h4 {
      margin: 0 0 6px;
      font-size: 17px;
      font-weight: 800;
      line-height: 1.12;
      color: #06262a;
      /* clamp to 2 lines so titles won't expand card height */
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      word-break: break-word;
      hyphens: auto;
    }

    .job-meta { font-size: 13px; color: #05353a; margin-bottom: 6px; }
    .job-meta div { margin-bottom: 6px; }

    .card-footer {
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap: 12px;
      margin-top: 6px;
      min-height: 44px;
    }

    .job-more {
      background:#fff;
      color:#0d4f57;
      border-radius:16px;
      padding:8px 14px;
      font-weight:700;
      border:1px solid rgba(0,0,0,0.06);
      box-shadow: 0 6px 14px rgba(0,0,0,0.06);
      text-decoration:none;
      white-space:nowrap;
    }

    .job-ref { font-size: 13px; color:#054a50; opacity:0.95; text-align:right; word-break:break-word; }

    /* Pagination */
    .jobs-pagination { margin-top: 22px; display:flex; justify-content:center; gap:12px; align-items:center; flex-wrap:wrap; }
    .btn-page {
      background:#0d73b9; color:#fff; padding:8px 14px; border-radius:6px; font-weight:700; text-decoration:none;
      box-shadow: 0 8px 20px rgba(13,115,185,0.12);
      display:inline-flex;
      align-items:center;
      justify-content:center;
    }

    /* Accessibility focus */
    .job-more:focus, .btn-page:focus { outline: 3px solid rgba(13,115,185,0.12); outline-offset: 3px; }

    /* Defensive: ensure children never exceed parent's width */
    .job-card * { max-width: 100%; }

    /* Tiny visual tweak for small screens */
    @media (max-width: 420px) {
      .hotjobs-wrap { padding-left: 12px; padding-right: 12px; }
      .page-title { font-size: 24px; }
    }
  </style>
@endpush

@section('content')
  <div class="hotjobs-page">
    <div class="hotjobs-wrap" data-aos="fade-up">

      <div class="hotjobs-box">
        <div style="text-align:center;">
          <h1 class="page-title">All Hot Jobs</h1>
        </div>

        {{-- Grid with 9 sample hot jobs (static). Replace with your server-side loop later --}}
        <div class="jobs-grid" role="list" aria-label="Hot jobs list">
          @for ($i = 1; $i <= 9; $i++)
            <article class="job-card" role="listitem" data-aos="fade-up" data-aos-delay="{{ $i * 20 }}">
              <div>
                <h4>Sample Job Title {{ $i }}</h4>
                <div class="job-meta">
                  <div><strong>Joining Date:</strong> 2025-09-1{{ $i }}</div>
                  <div><strong>Nationality:</strong> Indian</div>
                  <div><strong>Minimum Exp:</strong> {{ ($i % 3 === 0) ? '12 Months' : ($i % 2 === 0 ? '1 Year' : '6 Months') }}</div>
                </div>
              </div>

              <div class="card-footer">
                <a class="job-more" href="#">More</a>
                <div class="job-ref">Ref: #{{ strtoupper(substr(md5($i),0,6)) }}</div>
              </div>
            </article>
          @endfor
        </div> {{-- end .jobs-grid --}}

        {{-- Pagination: static example (replace with $jobs->links() if using paginator) --}}
        <div class="jobs-pagination" aria-label="Jobs pagination">
          <a class="btn-page" href="#">&laquo; Prev</a>
          <a class="btn-page" href="#">1</a>
          <a class="btn-page" href="#">2</a>
          <a class="btn-page" href="#">3</a>
          <a class="btn-page" href="#">Next &raquo;</a>
        </div>

      </div> {{-- end .hotjobs-box --}}

    </div> {{-- end .hotjobs-wrap --}}
  </div> {{-- end .hotjobs-page --}}
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (window.AOS) AOS.init({ once: true, duration: 600, easing: 'ease-in-out' });

      // Extra safety: if the wrapper still reports scrollWidth > clientWidth,
      // slightly reduce side padding to avoid overflow on odd browser setups.
      function fixOverflowIfNeeded(){
        const wrap = document.querySelector('.hotjobs-wrap');
        if (!wrap) return;
        if (Math.ceil(wrap.scrollWidth) > Math.ceil(wrap.clientWidth) + 1) {
          // reduce left/right padding incrementally (safe fallback)
          wrap.style.paddingLeft = '12px';
          wrap.style.paddingRight = '12px';
        }
      }
      window.addEventListener('load', fixOverflowIfNeeded);
      window.addEventListener('resize', fixOverflowIfNeeded);
    });
  </script>
@endpush
