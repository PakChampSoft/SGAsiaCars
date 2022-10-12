@extends('new_layouts.main')

@push('title')
    <title> {{$pagedata->seo_title}}</title>
@endpush

@push('meta')
<meta name="description" content="{{ $pagedata? $pagedata->meta_description: "" }}">
<meta name="keywords" content="{{ $pagedata? $pagedata->meta_keywords: "" }}">
@endpush

@section('content')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- MAIN SECTION -->
  <section id="main-section">
    <div class="custom-container-contact-us">
      <h1 class="text-2xl font-bold text-dark-black pt-3">Contact Us</h1>
      <hr class="border-blue-900 mt-auto">
      <form  action="{{ route('landing.contact') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="name" class="text-sm">Name</label>
          <input type="text" class="form-control text-sm rounded-md border-gray-input" name="name" id="name" aria-describedby="nameHelp" placeholder="Full Name" required="">
        </div>
        <div class="form-group">
          <label for="email" class="text-sm">Email address</label>
          <input type="email" class="form-control text-sm rounded-md border-gray-input" name="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" required="">
          <small id="emailHelp" class="form-text text-dark-black">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="phone" class="text-sm">Phone</label>
          <input type="text" class="form-control text-sm rounded-md border-gray-input" name="phone" id="phone" placeholder="Phone Number" required="">
        </div>
        <div class="form-group">
          <label for="country" class="text-sm">Country</label>
          <select class="form-control text-sm rounded-md border-gray-input" name="country" id="country" required="">
            <option value="">Select Country</option>
            @forelse ($countries as $country)
                <option value="{{ $country->name }}">{{ $country->name }}</option>
            @empty
                <option value="">No Country Found</option>
            @endforelse
          </select>
        </div>
        <div class="form-group">
          <label for="subject" class="text-sm">Subject</label>
          <input type="text" class="form-control text-sm rounded-md border-gray-input" name="subject" id="subject" placeholder="Subject" required="">
        </div>
        <div class="form-group">
          <label for="message" class="text-sm">Message</label>
          <textarea name="message" class="w-full text-sm rounded-md border-gray-input" id="message" rows="5" required=""></textarea>
        </div>
        <div class="for-group mb-3">
            <label for="recaptcha">Captcha <span class="text-danger">*</span></label>
            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
        </div>
        <div class="form-group pb-4">
          <button type="submit" class="w-full text-sm dark-blue-bg text-white py-2 rounded-md border-0">SEND MESSAGE <i class="las la-paper-plane"></i></button>
        </div>
      </form>
    </div>
    <div class="container">
      <!-- CONTACT US INFORMATION TABS -->
      @include('new_includes.contact-us-info')
      <!-- // CONTACT US INFORMATION TABS -->

    </div>
  </section>
  <!-- // MAIN SECTION -->
@endsection
