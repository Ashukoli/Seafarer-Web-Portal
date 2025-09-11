@extends('layouts.frontend.app')

@section('title', 'Contact Us - Seafarer Jobs')

@push('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
<style>
  .contact-page .intro {
    margin-bottom: 30px;
  }

  /* Card style for form */
  .contact-card {
    background: #fff;
    border-radius: 14px;
    padding: 32px;
    box-shadow: 0 12px 28px rgb(0 0 0 / 40%);
    border: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .contact-card h3 {
    margin-bottom: 20px;
    color: #197a91;
    font-weight: 700;
  }

  /* Modern input fields */
  .contact-card .form-control {
    border-radius: 12px;
    padding: 14px 16px;
    border: 1px solid rgba(0,0,0,0.1);
    margin-bottom: 18px;
    background: #fff;
    font-size: 15px;
    transition: all 0.2s ease;
    box-shadow: inset 0 2px 6px rgba(0,0,0,0.03);
  }
  .contact-card .form-control:focus {
    border-color: #0d73b9;
    box-shadow: 0 0 0 4px rgba(13,115,185,0.15);
  }

  /* Button */
  .contact-card button {
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


  /* Right-side info */
  .contact-info {
    background: #fff;
    border-radius: 14px;
    padding: 24px;
        box-shadow: 0 8px 20px rgb(0 0 0 / 40%);
    font-size: 15px;
  }
  .contact-info strong {
    display: block;
    margin-bottom: 8px;
    color: #0f6b78;
  }
  .contact-info p {
    margin-bottom: 8px;
    line-height: 1.6;
  }

  /* Map */
  .contact-map {
    margin-top: 18px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
  }
  .contact-map iframe {
    width: 100%;
    height: 250px;
    border: 0;
  }

  .leads {
    font-size: 17px;
    font-weight: 300;
}
</style>
@endpush

@section('content')
<div class="contact-page">
  <div class="container py-5">

    {{-- Intro --}}
    <div class="intro text-center" data-aos="fade-up">
      <h1>Contact Us</h1>
      <p class="leads">
        Do you have some comments about the site? Or maybe you just want to interact with us?
        Either way, feel free to get in touch with us using the contact form below or send a mail to
        <a href="mailto:info@seafarerjobs.com">info@seafarerjobs.com</a>, we will try to reply as soon as possible.
      </p>
    </div>

    <div class="row g-4">
      {{-- Contact Form --}}
      <div class="col-lg-7" data-aos="fade-right">
        <div class="contact-card">
          <h3>Send us a message</h3>
          <form action="#" method="POST">
            @csrf
            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
             <input type="email" class="form-control" name="mobile" placeholder="Your Mobile No." required>
            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
            <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit" class="btn w-100 mt-2">
              <i class="fa fa-paper-plane me-2"></i> Send Message
            </button>
          </form>
        </div>
      </div>

      {{-- Contact Info --}}
      <div class="col-lg-5" data-aos="fade-left">
        <div class="contact-info">
          <strong>Acrux Shipping Pvt. Ltd.</strong>
          <p>
            632, Ijimima Complex, Behind Infinity Mall<br>
            Off Link Road, Malad (W),<br>
            Mumbai - 400 064, Maharashtra, INDIA.
          </p>
          <p><i class="fa fa-envelope text-primary me-2"></i> info@seafarerjobs.com</p>

          {{-- Google Map --}}
          <div class="contact-map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3768.2641579675696!2d72.82907897466768!3d19.183661348584934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b748b0fd05ab%3A0x36dbdfa9a18dcb58!2sIjmima%20Complex!5e0!3m2!1sen!2sin!4v1757465068782!5m2!1sen!2sin"
              allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
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
