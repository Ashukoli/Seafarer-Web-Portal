@extends('layouts.frontend.app')

@section('title', 'Advertise - Seafarer Jobs')

@push('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
<style>
  .advertise-page .intro {
    margin-bottom: 30px;
  }

  /* Card style */
  .advertise-card {
    background: #fff;
    border-radius: 14px;
    padding: 32px;
    box-shadow: 0 12px 28px rgb(0 0 0 / 40%);
    border: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .advertise-card h3 {
    margin-bottom: 20px;
    color: #197a91;
    font-weight: 700;
  }

  /* Inputs */
  .advertise-card .form-control {
    border-radius: 12px;
    padding: 14px 16px;
    border: 1px solid rgba(0,0,0,0.1);
    margin-bottom: 18px;
    background: #fff;
    font-size: 15px;
    transition: all 0.2s ease;
    box-shadow: inset 0 2px 6px rgba(0,0,0,0.03);
  }
  .advertise-card .form-control:focus {
    border-color: #0d73b9;
    box-shadow: 0 0 0 4px rgba(13,115,185,0.15);
  }

  /* Button */
  .advertise-card button {
    background: linear-gradient(90deg,#197a91,#6f3f78);
    color: #fff;
    border: none;
    border-radius: 30px;
    padding: 14px 28px;
    font-weight: 700;
    font-size: 15px;
    box-shadow: 0 8px 20px rgba(20,20,40,0.12);
    transition: all 0.2s ease;
  }


  /* Info box */
  .advertise-info {
    background: #fff;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 8px 20px rgb(0 0 0 / 40%);
    font-size: 15px;
  }
  .advertise-info strong {
    display: block;
    margin-bottom: 8px;
    color: #0f6b78;
  }
  .advertise-info p {
    margin-bottom: 8px;
    line-height: 1.6;
  }

.leads {
    font-size: 17px;
    font-weight: 300;
}
</style>
@endpush

@section('content')
<div class="advertise-page">
  <div class="container py-5">

    {{-- Intro --}}
    <div class="intro text-center" data-aos="fade-up">
      <h1>Advertise</h1>
      <p class="leads">
        Advertising with Seafarerjobs.com is a great way to recruit seafarers through your company.
        Not only that, you can use it to send out the name of your company to a targeted audience of thousands of professional seafarers around the world.
        We offer many advertising options. For details, please contact us using the form below or send a mail to
        <a href="mailto:company@seafarerjobs.com">company@seafarerjobs.com</a>
      </p>
    </div>

    <div class="row g-4">
      {{-- Company Info --}}
      <div class="col-lg-5" data-aos="fade-right">
        <div class="advertise-info">
          <strong>Acrux Shipping Pvt. Ltd.</strong>
          <p>
            Office 632, IJMIMA Complex, Behind Infinity Mall, Mindspace Off Link Road,
            Malad (W), Mumbai - 400 064, Maharashtra, INDIA.
          </p>
          <p><i class="fa fa-phone text-primary me-2"></i> +91 8454972214</p>
          <p><i class="fa fa-envelope text-primary me-2"></i> company@seafarerjobs.com</p>
        </div>
      </div>

      {{-- Advertise Form --}}
      <div class="col-lg-7" data-aos="fade-left">
        <div class="advertise-card">
          <h3>Advertising Inquiry</h3>
          <form action="#" method="POST">
            @csrf
            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
            <input type="text" class="form-control" name="company_name" placeholder="Company Name" required>
            <input type="text" class="form-control" name="website" placeholder="Website">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
            <input type="text" class="form-control" name="phone" placeholder="Phone">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            <button type="submit" class="btn w-100 mt-2">
              <i class="fa fa-paper-plane me-2"></i> Submit
            </button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init({ once:true, duration:700, easing:'ease-in-out' });
</script>
@endpush
