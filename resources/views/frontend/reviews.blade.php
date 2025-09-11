{{-- resources/views/frontend/reviews.blade.php --}}
@extends('layouts.frontend.app')

@section('title', 'Candidate Reviews - Seafarer Jobs')

@push('head')
  <!-- AOS for scroll animations -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

  <style>
    /* Boxed layout helpers (matches hot-jobs) */
    *, *::before, *::after { box-sizing: border-box; }
    html, body { -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale; }
    html, body { overflow-x: hidden; }

    .reviews-page { background: #f4f6f9; padding: 0 0 60px; }
    .reviews-wrap {
      width: 100%;
      max-width: 1000px;
      margin: 0 auto !important;
      padding: 0 18px;
      position: relative;
      overflow: hidden;
      border: 1px solid rgb(106 129 145 / 25%);
    }

    .reviews-box {
      background: #ffffff;
      border-radius: 12px;
      border: 1px solid rgba(13,115,185,0.08);
      padding: 28px;
      box-shadow: 0 18px 50px rgba(10,20,40,0.08);
      width: 100%;
      overflow: hidden;
    }

    .page-title {
      text-align: center;
      color: #0b6b74;
      font-weight: 900;
      font-size: 30px;
      margin: 0 0 12px;
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

    /* Reviews list */
    .reviews-list {
      margin-top: 22px;
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 18px;
    }
    .reviews-list > * { min-width: 0; } /* prevents overflow */

    @media (max-width: 992px) {
      .reviews-list { grid-template-columns: 1fr; }
    }

    /* Single review card */
    .review-card {
      background: linear-gradient(180deg, #fbffff 0%, #eef8fb 100%);
      border-radius: 10px;
      padding: 18px;
      border: 1px solid rgb(13 115 185 / 28%);
      box-shadow: 0 8px 22px rgb(13 115 185 / 30%);
      display: flex;
      gap: 12px;
      align-items: flex-start;
      overflow: hidden;
      min-height: 110px;
    }

    .review-avatar {
      width:72px;
      height:72px;
      border-radius:8px;
      flex-shrink:0;
      background:#fff;
      display:flex;
      align-items:center;
      justify-content:center;
      border:1px solid rgba(0,0,0,0.04);
      box-shadow: 0 8px 20px rgba(10,20,40,0.04);
    }
    .review-avatar img { width:64px; height:64px; object-fit:cover; border-radius: 32px;
    border: 1px solid; }

    .review-body { flex:1 1 auto; min-width: 0; }
    .review-title { font-weight:800; color:#063033; margin:0 0 6px; font-size:16px; }
    .review-stars { color:#f6a623; font-size:18px; margin-bottom:6px; }
    .review-text { color:#0d4f57; font-size:14px; line-height:1.45; margin-bottom:8px; }
    .review-meta { font-size:13px; color:#0a6b71; font-weight:700; }

    /* Pagination */
    .reviews-pagination { margin-top: 22px; display:flex; justify-content:center; gap:12px; align-items:center; flex-wrap:wrap; }
    .btn-page { background:#0d73b9; color:#fff; padding:8px 14px; border-radius:6px; font-weight:700; text-decoration:none; box-shadow: 0 8px 20px rgba(13,115,185,0.12); }

    /* Accessibility focus */
    a:focus, button:focus { outline: 3px solid rgba(13,115,185,0.12); outline-offset: 3px; }

    /* small screens */
    @media (max-width:420px){
      .page-title { font-size: 22px; }
      .review-avatar { width:60px; height:60px; }
    }
  </style>
@endpush

@section('content')
  <div class="reviews-page">
    <div class="reviews-wrap" data-aos="fade-up">

      <div class="reviews-box">
        <h1 class="page-title">Candidate Reviews</h1>

        {{-- Reviews grid (static sample 8 reviews). Replace with server-side loop later --}}
        <div class="reviews-list" role="list" aria-label="Candidate reviews">
          @php
            $sampleReviews = [
              ['name'=>'Vivek G (4th Eng.)','rating'=>5,'text'=>'Nice site, hopefuly can find a job here. Great database and easy interface.'],
              ['name'=>'Rahul M (Ch. Off.)','rating'=>5,'text'=>'Good source for seafarer jobs and reliable database. Recommended.'],
              ['name'=>'Sandeep K (Bosun)','rating'=>4,'text'=>'Site works well — found many useful leads.'],
              ['name'=>'Arjun P (Motorman)','rating'=>5,'text'=>'Quick response from recruiters after posting resume. Very helpful.'],
              ['name'=>'Rexmotha R (Motorman/Oiler)','rating'=>4,'text'=>'Good platform — needs occasional UI polish but overall excellent.' ],
              ['name'=>'Kumar S (Deck Cadet)','rating'=>5,'text'=>'Solid resource for freshers — got interview invites quickly.' ],
              ['name'=>'Manoj T (2nd Eng.)','rating'=>4,'text'=>'Good exposure — recruiter quality varies but database is strong.' ],
              ['name'=>'Prakash A (Officer)','rating'=>5,'text'=>'Seafarerjobs helped me connect with the right employer. Highly recommended.' ],
            ];
          @endphp

          @foreach($sampleReviews as $idx => $r)
            <div class="review-card" role="listitem" data-aos="fade-up" data-aos-delay="{{ $idx * 30 }}">
              <div class="review-avatar" aria-hidden="true">
                {{-- placeholder avatar (letters) or use image --}}
                <img src="https://ui-avatars.com/api/?name={{ urlencode($r['name']) }}&background=ffffff&color=0d6b74&size=128" alt="">
              </div>

              <div class="review-body">
                <div class="review-title">{{ $r['name'] }}</div>
                <div class="review-stars" aria-hidden="true">{!! str_repeat('★', $r['rating']) !!}</div>
                <div class="review-text">{{ $r['text'] }}</div>
                <div class="review-meta">Verified user</div>
              </div>
            </div>
          @endforeach
        </div>

        {{-- Pagination placeholder --}}
        <div class="reviews-pagination" aria-label="Reviews pagination">
          <a class="btn-page" href="#">&laquo; Prev</a>
          <a class="btn-page" href="#">1</a>
          <a class="btn-page" href="#">2</a>
          <a class="btn-page" href="#">Next &raquo;</a>
        </div>
      </div>

    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (window.AOS) AOS.init({ once: true, duration: 600, easing: 'ease-in-out' });
    });
  </script>
@endpush
