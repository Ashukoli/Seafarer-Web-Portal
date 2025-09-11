{{-- resources/views/frontend/disclaimer.blade.php --}}
@extends('layouts.frontend.app')

@section('title', 'Disclaimer - Seafarer Jobs')

@push('head')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
  <style>
    .disclaimer-page { font-size:15px; line-height:1.7; color:#333; }
    .disclaimer-page .card {
      background:#fff;
      border-radius:10px;
      padding:24px;
      box-shadow:0 8px 24px rgba(0,0,0,0.06);
      margin-bottom:20px;
    }
    .disclaimer-page h1 {
      color:#197a91;
      font-size:28px;
      margin-bottom:14px;
      font-weight:700;
    }
    .disclaimer-page p { margin-bottom:12px; }
    @media (max-width:768px){
      .disclaimer-page .card { padding:16px; }
    }
  </style>
@endpush

@section('content')
<div class="disclaimer-page">
  <div class="container py-5">
    <div class="card" data-aos="fade-up">
      <h1>Disclaimer</h1>

      <p>
        Seafarerjobs.com makes an attempt to match the jobseekers with the employers/recruiters. This is not a placement/recruiting company.
      </p>

      <p>
        We make attempts to check the authenticity of the reading material provided on the Seafarerjobs.com website. For this purpose we also ask for the email addresses and send confirmation mails to those addresses every time a submission is made. In case of a mail bouncing back, we reserve the right to delete such submissions without further enquiries.
      </p>

      <p>
        Besides the above, we cannot possibly cross-check the authenticity of the submissions. We, therefore, cannot be responsible for the matter published in the sections where inputs are made by visitors to the site. The web surfer, job-seeker or the employers are requested to cross-check and validate the information before hiring/accepting the offer.
      </p>

      <p>
        Neither Seafarerjobs.com nor any of its providers of information make any warranties, express or implied, as to results to be obtained from use of such information, and make no express or implied warranties of merchantability or fitness for a particular purpose or use.
      </p>

      <p>
        Neither Seafarerjobs.com nor any of its providers of information, service providers including site owners shall have any liability for the accuracy of the information contained in the service, or the contents of any advertisements, or for assertions or omissions therein. None of the foregoing parties shall be liable for any third-party claims or losses of any nature, including, but not limited to, lost profits, punitive or consequential damages. Seafarerjobs.com reserves the right to remove any listings or any advertisements without assigning any reason whatsoever.
      </p>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (window.AOS) {
        AOS.init({ once: true, duration: 700, easing: 'ease-in-out' });
      }
    });
  </script>
@endpush
