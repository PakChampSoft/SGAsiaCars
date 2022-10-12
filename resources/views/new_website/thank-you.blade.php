@extends('new_layouts.main')

@push('title')
    <title> Thank You </title>
@endpush

@push('meta')
<meta name="description" content="">
<meta name="keywords" content="">
@endpush

@section('content')
  <!-- MAIN SECTION -->
  <section id="main-section">
    <div class="custom-container-contact-us">
      <h1 class="text-2xl font-bold text-dark-black pt-3 text-center text-success">Thank You! Your Inquiry Submitted Successfully.</h1>
      <div class="row">
        <div class="col-12 text-center mt-2">
            <img src="{{ asset('assets/images/envolope.png') }}" class="img-fluid text-center" style="height: 90px; width:150px">
        </div>
      </div>

      <i class="fa-solid fa-message"></i>
      <p class="text-dark-black p-3">You will recieve an email shortly with the <b>Price Quote</b>.
        <br>
        If you have more questions, please reply to this email so we can assist you.</p>
        <hr>
        <h1 class="text-2xl font-bold text-dark-black pt-3 text-center text-success">Sign Up To Receive Exclusive Discount Coupons!</h1>
        <p class="text-dark-black p-3">You can also view your favorite cars and receive notification on reduce prices.</p>
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('register') }}">
                    <button class="btn bg-success text-white text-center">Sign Up <i class="las la-envelope-open text-white"></i></button>
                </a>
            </div>
            <div class="col-12 text-center mt-3 ">
                <i class="text-dark-black pb-3">Already Have An Account?</i>
            </div>
            <div class="col-12 text-center mb-4">
                <a href="{{ route('login') }}">
                    <button class="btn bg-danger text-white text-center">Login <i class="las la-sign-in-alt text-white"></i></button>
                </a>
            </div>
        </div>

    </div>
    <div class="container">
      <!-- CONTACT US INFORMATION TABS -->
      @include('new_includes.contact-us-info')
      <!-- // CONTACT US INFORMATION TABS -->

    </div>
  </section>
  <!-- // MAIN SECTION -->
@endsection
