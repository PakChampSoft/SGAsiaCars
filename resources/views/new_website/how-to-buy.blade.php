@extends('new_layouts.main')

@push('title')
    <title> {{$pagedata->seo_title}}</title>
@endpush

@push('meta')
<meta name="description" content="{{ $pagedata? $pagedata->meta_description: "" }}">
<meta name="keywords" content="{{ $pagedata? $pagedata->meta_keywords: "" }}">
@endpush

@section('content')
  <!-- MAIN SECTION -->
  <section id="main-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-4 d-none d-md-block d-lg-block d-xl-block">
            @include('new_includes.search-left-side-bar')
        </div>
        <div class="col-lg-10 col-md-8 mb-5">
            <h1 class="dark-blue-text font-bold text-xl">How To Buy</h1>
            <hr class="border-width border-blue-600 mt-auto">
            <!-- STEP 1 -ORDER -->
                <fieldset class="fieldset-border p-2 w-full">
                    <legend class="float-none w-auto text-xl font-bold padding-right-left-10 color-black">STEP 1 - ORDER</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="steps-image">
                                <img src="{{ asset('images/buy/s1.png') }}" class="img-width" alt="">
                                <p class="text-center text-sm color-black pt-3 pb-3">CHOOSE THE VEHICLE YOU WANT TO PURCHASE.OUR CAR SEARCH ENGINE WILL HELP YOU SEARCH THROUGH OUR INVENTORY.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="steps-image">
                                <img src="{{ asset('images/buy/s2.png') }}" class="img-width" alt="">
                                <p class="text-center text-sm color-black pt-3 pb-3">YOU CAN ALSO CUSTOMIZE SEARCH DEPENDING ON YOUR REQUIREMENT AND PREFERENCES. DETAILED PHOTOS AND SPECIFICATIONS CAN BE SEEN FOR EACH INVENTORY.</p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            <!--// STEP 1 -ORDER -->

            <!-- STEP 2 -ORDER -->
                <fieldset class="fieldset-border p-2 w-full mt-3">
                    <legend class="float-none w-auto text-xl font-bold padding-right-left-10 color-black">STEP 2 - BUY NOW</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="steps-image">
                                <img src="{{ asset('images/buy/s3.png') }}" class="img-width" alt="">
                                <p class="text-center text-sm color-black pt-3 pb-3">SET YOUR PURCHASE CONDITION LIKE DESTINATION COUNTRY,DESTINATION PORT AND SO ON.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="steps-image pb-5" style="top: 35%;">
                                <img src="{{ asset('images/buy/s4.png') }}" class="img-width" alt="">
                                <p class="text-center text-sm color-black pt-3 pb-3">And Click "Quote Request"</p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            <!-- // STEP 2 -ORDER -->
            <!-- STEP 3 -ORDER -->
            <fieldset class="fieldset-border p-2 w-full mt-3">
                <legend class="float-none w-auto text-xl font-bold padding-right-left-10 color-black">STEP 3 - MAKE PAYMENT</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="steps-image">
                            <img src="assets/images/s5.png" class="img-width" alt="">
                            <p class="text-center text-sm color-black pt-3 pb-3">BANK WIRE TRANSFER (TELEGRAPHIC TRANSFER) ALL CUSTOMER SHOULD SEND MONEY ONLY TO SGASIACARS CO,LTD. BENEFICIARY ACCOUNTS IN JAPAN</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="steps-image pb-3" style="top: 10%;">
                            <img src="assets/images/s6.png" class="img-fluid" alt="">
                            <p class="text-center text-sm color-black pt-3 pb-3">PAYPAL PAYMENT ASK YOUR SALES REPRESENTATIVE TO GET INVOICE FOR ONLY PAYPAL THEN YOU WILL GET PAYPAL ACCOUNT ADDRESS</p>
                        </div>
                    </div>
                </div>
            </fieldset>
        <!--// STEP 3 -ORDER -->
        <!-- STEP 4 -ORDER -->
            <fieldset class="fieldset-border p-2 w-full mt-3">
                <legend class="float-none w-auto text-xl font-bold padding-right-left-10 color-black">STEP 4 - SHIPMENT</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="steps-image">
                            <img src="{{ asset('images/buy/s7.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="steps-image pb-3">
                            <img src="{{ asset('images/buy/s8.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
                <p class="text-center text-sm color-black pt-3 pb-3">TRACK YOUR SHIPMENT</p>
            </fieldset>
        <!--// STEP 4 -ORDER -->
        <!-- STEP 5 -ORDER -->
        <fieldset class="fieldset-border p-2 w-full mt-3">
            <legend class="float-none w-auto text-xl font-bold padding-right-left-10 color-black">STEP 5 - CUSTOM CLEARANCE</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="steps-image">
                        <img src="{{ asset('images/buy/s9.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="steps-image pb-3">
                        <img src="assets/images/s10.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <p class="text-center text-sm color-black pt-3 pb-3">COMPLETE CUSTOM CLEARANCE</p>
        </fieldset>
    <!--// STEP 5 -ORDER -->
        </div>
      </div>
      <!-- CONTACT US INFORMATION TABS -->
      @include('new_includes.contact-us-info')
      <!-- // CONTACT US INFORMATION TABS -->

    </div>
  </section>
  <!-- // MAIN SECTION -->

@endsection
@push('js')
    {{-- Rage Slider --}}
    <script>
        $('.range-slider').jRange({
            from: 0,
            to: 50000,
            step: 1000,
            scale: [0, 50000],
            format: 'USD %s',
            width: 150,
            showLabels: true,
            isRange: true,
            onstatechange: function() {
                var vals = $('.range-slider').val();
                var avals = vals.split(',')
                var min = avals[0];
                var max = avals[1];

                $('#min_price').val(min);
                $('#max_price').val(max);
            }
        });
    </script>
    {{--// Rage Slider --}}
@endpush
