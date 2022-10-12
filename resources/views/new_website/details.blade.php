@extends('new_layouts.main')

@push('title')
<title>{{ $seo_title }}</title>
@endpush

@push('meta')
<meta property="og:title" content="{{ $product->manufacture_date ?? '' }} {{ $product->vcompany->name ?? '' }} {{ $product->drive_type ?? '' }} {{ $product->transmission ?? '' }}" />
<meta property="og:description" content="SGASIA CARS" />
<meta property="og:image" content="{{ asset($product->main_image_name) }}" />
{{-- Metadata for METADATA DESCRIPTION AND METADATA KEYWORDS --}}
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">
{{-- // Metadata for METADATA DESCRIPTION AND METADATA KEYWORDS --}}
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('lightbox/css/lightbox.min.css') }}">
@endpush
@section('content')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- MAIN SECTION -->
    <section id="main-section">
        <div class="container">
            <!-- SIDEBAT AND PHOTO GALLARY -->
            <div class="row">
                <div class="col-lg-4">
                    <h1 class="dark-blue-text text-lg font-bold text-center pt-3  pb-3">
                        {{ $product->manufacture_date ?? '' }} {{ $product->vcompany->name ?? '' }}
                        {{ $product->vtype->name ?? '' }} {{ $product->drive_type ?? '' }}
                        {{ $product->transmission ?? '' }}</h1>

                    @if ($product->sold == 0)
                        <!-- Product Sold 0  if product available-->
                        <div class="product-zero mb-4">
                            <div class="row m-auto">
                                <div class="col-xs-6 col-md-6">
                                    <p class="text-gray-400 font-bold">{{ $product->ref_no ?? '' }}</p>
                                </div>
                                <div class="col-xs-6 col-md-6 text-right">
                                    <button class="px-6 gray-box rounded-md box-shadow-gray" onclick="printdiv();"><i
                                            class="las la-print"></i>Print</button>
                                </div>
                            </div>
                            <div class="row m-auto pt-3 pb-3">
                                <div class="col-xs-6 col-md-6">
                                    <div
                                        class="dark-blue-bg text-white text-center p-1 border-r border-white text-truncate">
                                        CURRENT PRICE</div>
                                </div>
                                <div class="col-xs-6 col-md-6 text-right">

                                    <div
                                        class="dark-blue-bg text-white text-center p-1 border-r border-white font-weight-bold">
                                        <span
                                            class="text-red-400 font-normal text-sm mr-4 line-through">{{ $product->discount ? 'USD ' . $product->discount : '' }}</span>
                                        USD {{ $product->price }}
                                    </div>

                                    <input type="hidden" id="prod_price" value="{{ $product->price }}">
                                </div>
                            </div>
                            <div class="row m-auto">
                                <div class="col-sm-12  text-center">
                                    <button class="btn btn-danger">GET A PRICE QUOTE NOW</button>
                                </div>
                            </div>
                        </div>
                        <!-- // Product Sold 0 -->
                    @endif


                    @if ($product->sold == 1)
                        <!-- Product Sold 1 if product sold-->
                        <div class="product-one  mb-4">
                            <div class="row m-auto">
                                <div class="col-xs-6 col-md-6">
                                    <p class="text-gray-400 font-bold">{{ $product->ref_no ?? '' }}</p>
                                </div>
                                <div class="col-xs-6  col-md-6 text-right">
                                    <button class="px-6 gray-box rounded-md box-shadow-gray"
                                        onclick="printdiv('div_print');"><i class="las la-print"></i>Print</button>
                                </div>
                            </div>
                            <div class="row m-auto pt-3 pb-3">
                                <div class="col-xs-12  col-md-12">
                                    <div
                                        class="bg-green-500 text-white text-center p-1 border-r border-white font-weight-bold">
                                        SOLD</div>
                                </div>
                            </div>
                            <div class="row m-auto ">
                                <div class="col-xs-12  col-md-12  mb-3 text-center">
                                    <a
                                        href="{{ route('landing.stocklist', ['maker' => $product->company, 'model' => $product->vmodel]) }}">
                                        <button class="btn btn-danger">See Similar Vehicles</button></a>
                                </div>
                            </div>
                            <div class="row m-auto">
                                <div class="col-xs-12 col-md-12 mb-3 text-center">
                                    <a href="{{ route('pre-order', $product->id) }}"
                                        class="text-white dark-blue-bg rounded-md px-2 py-2 font-bold"
                                        style="box-shadow: 2px 2px 10px lightblue;">Pre Order</a>
                                </div>
                            </div>
                        </div>
                        <!-- // Product Sold 1 -->
                    @endif


                    @if ($product->sold == 2 )
                        <!-- Product Sold 2 if product IN OFFER -->
                        <div class="product-two  mb-4 ">
                            <div class="row m-auto">
                                <div class="col-xs-6 col-md-6">
                                    <p class="text-gray-400 font-bold">{{ $product->ref_no ?? '' }}</p>
                                </div>
                                <div class="col-xs-6 col-md-6 text-right">
                                    <button class="px-6 gray-box rounded-md box-shadow-gray"
                                        onclick="printdiv('div_print');"><i class="las la-print"></i>Print</button>
                                </div>
                            </div>
                            <div class="row m-auto pt-3 pb-3">
                                <div class="col-xs-12 col-md-12">
                                    <div
                                        class="bg-gray-500 text-white text-center p-1 border-r border-white font-weight-bold">
                                        ON OFFER</div>
                                </div>
                            </div>
                            <div class="row m-auto ">
                                <div class="col-xs-12 col-md-12  mb-3 text-center">
                                    <a
                                        href="{{ route('landing.stocklist', ['maker' => $product->company, 'model' => $product->vmodel]) }}">
                                        <button class="btn btn-danger">See Similar Vehicles</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- // Product Sold 2 -->
                    @endif

                    @if ($product->sold == 3 && $product->onhold_duration!=null)
                        @php
                            $currentTime = \Carbon\Carbon::now();
                            $holdTime = $product->onhold_duration;
                            // $remainingTime = $holdTime->diffInSeconds($currentTime);
                            $remainingHours = $holdTime->diffInHours($currentTime);
                            $remainingMinuts = $holdTime->diff($currentTime)->format('%I');
                            $remainingSeconds = $holdTime->diff($currentTime)->format('%S');
                            // $remainingTime = $holdTime->diffInHours($currentTime) . ':' . $holdTime->diff($currentTime)->format('%I:%S');
                        @endphp
                        <!-- Product Sold 3 if product on hold-->
                        <div class="product-two  mb-4 ">
                            <div class="row m-auto">
                                <div class="col-xs-6 col-md-6">
                                    <p class="text-gray-400 font-bold">{{ $product->ref_no ?? '' }}</p>
                                </div>
                                <div class="col-xs-6 col-md-6 text-right">
                                    <button class="px-6 gray-box rounded-md box-shadow-gray"
                                        onclick="printdiv('div_print');"><i class="las la-print"></i>Print</button>
                                </div>
                            </div>
                            <div class="row m-auto pt-3 pb-3">
                                <div class="col-xs-12 col-md-12 text-center">
                                    <div
                                        class="bg-yellow-500 text-white text-center font-bold p-1 border-r border-white flex-1">
                                        ON HOLD</div>
                                    <p class="text-lg color-black mt-3">It could become available in:</p>
                                    <h3 class="text-center text-2xl font-bold" id="hold_timer">
                                        <span id="rhours" class="dark-blue-text">{{ $remainingHours }}</span>
                                        <span class="text-xs">h</span>
                                        <span id="rminutes" class="dark-blue-text">{{ $remainingMinuts }}</span>
                                        <span class="text-xs">m</span>
                                        <span id="rseconds" class="dark-blue-text">{{ $remainingSeconds }}</span>
                                        <span class="text-xs">s</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="row m-auto ">
                                <div class="col-xs-12 col-md-12  mb-4 text-center">
                                    <button class="btn btn-danger">See Similar Vehicles</button>
                                </div>
                                <div class="col-xs-12 col-md-12 mb-3 text-center">
                                    <a href="{{ route('user.notification.store', $product->id) }}"
                                        class="text-white bg-green-600 rounded-md px-2 py-2 font-bold"
                                        style="box-shadow: 2px 2px 10px lightblue;">Notify Me When Available</a>
                                </div>
                            </div>
                        </div>
                        <!-- // Product Sold 3 -->
                    @endif
                    <!-- PRODUCT SPECIFICATION -->
                    <div class="specs">
                        <span class="dark-blue-bg text-white px-1">Specs</span>
                        <table class="table mb-2 table-borderless">
                            <tbody>
                                <tr class="font-weight-bold">
                                    <td class="text-sm">Mileage</td>
                                    <td class="text-sm">Year</td>
                                    <td class="text-sm">Engine</td>
                                    <td class="text-sm">Transmission</td>
                                    <td class="text-sm">Fuel</td>
                                </tr>
                                <tr class="font-weight-bold">
                                    <td>{{ $product->mileage }}</td>
                                    <td>{{ $product->manufacture_date }}</td>
                                    <td>{{ $product->engine_cc }}</td>
                                    <td>{{ $product->transmission }}</td>
                                    <td>{{ $product->fuel_type }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered pt-0">
                            <tbody>
                                <tr class="">
                                    <td class="font-weight-bold text-xs">REF #</td>
                                    <td>{{ $product->ref_no ?? '-' }}</td>
                                    <td class="font-weight-bold text-xs">LOCATION</td>
                                    <td>{{ $product->vcountry->name ?? '-' }}</td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold text-xs">CHAIS #</td>
                                    <td>{{ $product->chassis_no ?? '-' }}</td>
                                    <td class="font-weight-bold text-xs">CLASS</td>
                                    <td>{{ $product->grade ?? '-' }}</td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold text-xs">ENGINE SIZE</td>
                                    <td>{{ $product->engine_cc ?? '-' }} CC</td>
                                    <td class="font-weight-bold text-xs">DRIVE</td>
                                    <td>{{ $product->drive_type ?? '-' }}</td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold text-xs">STEERTING</td>
                                    <td>{{ $product->steering ?? '-' }}</td>
                                    <td class="font-weight-bold text-xs">TRANSMISSION</td>
                                    <td>{{ $product->transmission ?? '-' }}</td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold text-xs">REG# YEAR</td>
                                    <td>{{ $product->manufacture_date ?? '-' }}</td>
                                    <td class="font-weight-bold text-xs">COLOR</td>
                                    <td>{{ $product->color->name ?? '-' }}</td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold text-xs">FUEL</td>
                                    <td>{{ $product->fuel_type ?? '-' }}</td>
                                    <td class="font-weight-bold text-xs">MANUFACTURE YEAR</td>
                                    <td>{{ $product->manufacture_date ?? '-' }}</td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold text-xs">SEAT</td>
                                    <td>{{ $product->seats ?? '-' }}</td>
                                    <td class="font-weight-bold text-xs">DOORS</td>
                                    <td>{{ $product->no_of_doors ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- // PRODUCT SPECIFICATION -->

                </div>
                <div class="col-lg-2 overflow-auto mb-4 order-lg-2 order-3" style=" height: 525px;">

                    @forelse ($product->photos->where('is_private', 0)->sortBy('sorting_order') as $photo)
                    <a href="{{ asset($photo->name) }}" data-lightbox="vehicle-images">
                        <img src="{{ asset($photo->name) }}" alt="" class="img-fluid mb-1">
                    </a>
                    @empty

                    @endforelse


                </div>
                <div class="col-lg-6 order-lg-6 order-2">
                    <a href="{{ asset($product->main_image_name) }}" data-lightbox="vehicle-images">
                        <img src="{{ asset($product->main_image_name) }}" alt="" class="img-fluid position-relative {{ $product->sold != 0 ? 'opacity-50' : '' }}">
                        @if ($product->sold == 1 )
                            <img src="{{ asset('images/sold2.png') }}" class="img-fluid position-absolute opacity-50" style="left: 10px;" alt="sold">
                        @endif
                        @if ($product->sold == 3)
                            <img src="{{ asset('images/hold.png') }}" class="img-fluid position-absolute opacity-50" style="left: 0px;" alt="hold">
                        @endif
                    </a>
                    <br>
                    <a href="{{ route('products.zip', $product->id) }}" class="text-sm dark-blue-text underline mb-3">Download Pictures In a Single Zip file</a>
                    <p class="text-xs my-2 color-black">Share with others</p>
                    <div class="social mt-4 mb-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}&src=sdkpreparse" target="_blank"
                            class="bg-blue-600 text-white px-2 py-2 text-xl bg-gray-500 fb-share-button vertical-middle"><i
                                style="font-size: 30px;" class="lab la-facebook"></i></a>
                        <a href="whatsapp://send?text={{ request()->url() }}" target="_blank"
                            class="bg-green-600 text-white px-2 py-2 text-xl bg-gray-500 vertical-middle"><i
                                style="font-size: 30px;" class="lab la-whatsapp"></i></a>
                        <a href="viber://forward?text={{ request()->url() }}" target="_blank"
                            class="bg-purple-600 text-white px-2 py-2 text-xl bg-gray-500 vertical-middle"><i
                                style="font-size: 30px;" class="lab la-viber"></i></a>
                        <a href="https://social-plugins.line.me/lineit/share?url={{ request()->url() }}" target="_blank"
                            class="bg-green-600 text-white px-2 py-2 text-xl bg-gray-500 vertical-middle"><i
                                style="font-size: 30px;" class="lab la-line"></i></a>
                        <a href="mailto:?subject={{ $product->vcompany->name .' ' . $product->vtype->name }} - SG Asia Cars&body={{ request()->url() }}" target="_blank"
                            class="bg-red-600 text-white px-2 py-2 text-xl bg-gray-500 vertical-middle"><i
                                style="font-size: 30px;" class="lab la-google"></i></a>
                    </div>
                </div>
            </div>
            <!-- // SIDEBAR AND PHOTO GALLARY -->

            <!-- FEATURES SECTION -->
            <div class="row gray-box pb-3">
                <div class="col-md-4">
                    <div class="w-full dark-blue-bg py-1 px-1 text-white text-center text-lg font-bold mb-3">
                        <span>STANDARD FEATURES</span>
                    </div>
                    <!-- ASSESRIES -->
                    <div class="grid grid-cols-4 gap-2 dark-blue-text text-xs text-center">
                        @php
                            $features = explode(",", $product->accessories);
                        @endphp
                        @forelse ($accessories as $accessory)
                        <div class="p-1 {{ in_array($accessory->id, $features) ? 'bg-blue-200' : '' }}  flex items-center justify-center break-words"
                            style="box-shadow: 1px 1px 5px grey">{{ $accessory->name }}</div>
                        @empty
                            <h6>No Accessories Found</h6>
                        @endforelse

                    </div>
                </div>
                <!-- FORM STATRTED -->
                @if ($product->sold ==0)
                <div class="col-md-8 mt-2">

                    <div class="bg-white py-1 dark-blue-text px-1 font-bold text-lg">
                        <p>STEP 1 &gt; <i class="las la-globe"></i> SHIPPING DESTINATION</p>
                    </div>
                    <div class="dark-blue-bg">
                        <!-- TILL DISCOUNT BUTTON -->
                        <div class="row m-auto pt-3">
                            <div class="col-sm-4">
                                <h3 class="text-white text-sm vertical-middle pt-2">FINAL COUNTRY</h3>
                            </div>
                            <div class="col-sm-8">
                                <form action="">
                                    <select class="form-control w-80" name="country" id="location">
                                        <option selected>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option {{ $country->name == $location ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <h4 class="text-white text-sm">PORT/CITY</h4>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <h1 class="text-white text-sm" id="port-city">KARACHI</h1>
                                <p class="text-white text-xs">pick up at port (RORO)</p>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <button class="px-6 bg-blue-400 text-white rounded-md shadow-lg" type="button"
                                    id="close_btn" data-toggle="collapse" data-target="#collapseExample"
                                    aria-expanded="false" aria-controls="collapseExample">Show Prices <i
                                        class="las la-angle-up"></i></button>
                                <button class="px-4 bg-blue-400 text-white rounded-md shadow-lg hidden" type="button"
                                    id="show_btn" data-toggle="collapse" data-target="#collapseExample"
                                    aria-expanded="false" aria-controls="collapseExample">Close <i
                                        class="las la-angle-down"></i></button>
                            </div>
                            <div class="col-sm-12 mt-3 mb-3">
                                <div class="collapse" id="collapseExample">
                                    <div class="">
                                        <h1 class="text-sm text-white" id="from-city">From Abu dhabi port to</h1>
                                    </div>
                                    <div id="ports-table">
                                    </div>
                                </div>
                            </div>
                            <!-- ADDITIONAL OPTIONS -->
                            <div class="col-sm-12 mb-3">
                                <p class="text-white text-sm">Additional Options</p>
                            </div>
                            <div class="col-sm-12">
                                <label for="marine" class="text-white">
                                    <input type="checkbox" name="marine" id="marine">
                                    Marine Insurance <span><i class="las la-question-circle"
                                            title="Marine Insurance covers the total loss by shipwreck"></i></span>
                                </label>
                            </div>
                            <div class="col-sm-12">
                                <label for="sginsp" class="text-white">
                                    <input type="checkbox" name="marine" id="sginsp">
                                    Inscpection
                                </label>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label for="sgwar" class="text-white">
                                    <input type="checkbox" name="marine" id="sgwar">
                                    SG Waranty
                                </label>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <h5 class="cursor-pointer text-white" id="discount_btn">Discount Coupon Code <i
                                        class="las la-angle-down"></i></h5>

                            </div>
                            <div class="col-sm-12 mb-3" id="discount_body">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <input type="text" class="form-control text-sm " name="coupon_code" id="coupon_code"
                                        placeholder="#FKEFDE">
                                    <button type="button" class="btn btn-info text-sm bg-blue-300">Apply</button>
                                </div>
                            </div>
                            <hr class="mt-2 col-sm-12 text-white">
                            <div class="col-xs-6 col-md-6 mb-3">
                                <h4 class="text-white text-lg">Total Price:</h4>
                            </div>
                            <div class="col-xs-6 col-md-6 text-right mb-3">
                                <h5 class="text-lg text-white font-weight-bold">CNF <span class="text-white"
                                        id="totalEstimate"></span></h5>
                            </div>
                        </div>
                        <!-- // TILL DISCOUNT BUTTON -->

                        <!-- STEP - 2 -->
                        <div class="bg-white py-1 dark-blue-text px-1 font-bold text-lg">
                            <p>STEP 2 &gt; <i class="las la-envelope"></i> GET A QUOTE
                            </p>
                        </div>
                        <!-- SEND QUOTE REQUEST -->
                        <div class="row m-auto pt-3">
                            <p class="text-white col-sm-12 text-sm mb-3">Please fill the <span
                                    class="text-danger">* </span>required fields.</p>

                            <div class="col-sm-12">
                                <form action="{{ route('landing.quote-request') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name" class="text-white">Your Name<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Full Name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="country" class="text-white">Your Country<span
                                                    class="text-danger">*</span></label>
                                            <select required name="country" id="country" class="form-control" >
                                                <option selected>Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option {{ $country->name == $location ? 'selected' : '' }} value="{{ $country->name }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name" class="text-white">Email<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email Address" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="country" class="text-white">Address<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                placeholder="Street, Town, Province" required>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name" class="text-white">Tel<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="tel" id="tel"
                                                placeholder="Cell Phone or Telephone No." required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="country" class="text-white">City<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="city" id="city"
                                                placeholder="Street, Town, Province" required>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-sm-12">
                                            <label for="name" class="text-white">Captcha<span
                                                    class="text-danger">*</span></label>
                                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                        </div>
                                    </div>
                                    <div class="form-row text-center">
                                        <div class="form-group col-sm-12">
                                            <button type="submit"
                                                class="bg-info text-white py-2 px-6 rounded-sm send-quote-btn"><i
                                                    class="las la-envelope"></i> SEND QUOTE REQUEST</button>
                                        </div>
                                    </div>
                                    <div class="form-row text-center">
                                        <div class="form-group col-sm-12">
                                            <a href="https://api.whatsapp.com/send/?phone=+66917869096&text={{ request()->url() }}"
                                                target="_blank" class="bg-green-600 text-white py-2 px-6 rounded-sm"><i
                                                    class="lab la-whatsapp"></i> Whatapp</a>
                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div>
                        <!--// SEND QUOTE REQUEST -->
                        <!-- // STEP 2 -->
                    </div>



                </div>
                @endif
                <!-- FORM STATRTED -->
            </div>
            <!-- //FEATURES SECTION -->
            <!-- VEHICLES AREAS STARTED -->
            <div class="row mt-4">
                <div class="col-sm-12 mb-4">
                    <span class="span-cols-1 dark-blue-bg py-1 text-white text-center text-lg font-bold">SIMILAR AND
                        RELATED VEHICLES</span>
                </div>
                @forelse ($similarProducts as $product)
                <div class="col-sm-4 col-lg-2 mb-4">
                    <a href="{{ strtolower(route('landing.detail', [$product->vcompany->name,  $product->drive_type ?: 'Both', Str::slug($product->vtype->name, '_'), $product->engine_cc, $product->ref_no])) }}">
                    <div class="card">
                        <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                        <div class="card-body dark-blue-bg padding-5">
                            <h6 class="text-white font-12 text-center">{{ $product->vcompany->name . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}</h6>
                        </div>
                        <div class="">
                            <h1 class="text-xs text-center py-1">{{ $product->manufacture_date . ' | ' . $product->transmission  }}</h1>
                            <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                        </div>
                        <div class="gray-box">
                            <h5 class="dark-blue-text font-bold text-center font-12">USD {{ $product->price ?? '' }}</h5>
                        </div>
                    </div>
                </a>
                </div>
                @empty
                <div class="col-sm-12 mb-4">
                    <h3>No Similar Products Found</h3>
                </div>
                @endforelse

            </div>
            <!-- // VEHICLES AREAS -->
        </div>
        <div class="container">
            <!-- CONTACT US INFORMATION TABS -->
            @include('new_includes.contact-us-info')
            <!-- // CONTACT US INFORMATION TABS -->

        </div>
    </section>
    <!-- // MAIN SECTION -->
@endsection

@push('js')
    <script src="{{ asset('lightbox/js/lightbox.min.js') }}"></script>
    <!-- CUSTOM SCRIPT -->
    <script>
        function printdiv(printpage) {
            window.print();
        }
        $(document).ready(function() {

            $("#close_btn").click(function() {
                $("#show_btn").removeClass('hidden');
                $("#close_btn").addClass('hidden');
                $("#port_details").addClass('hidden');
            });

            $("#show_btn").click(function() {
                $("#show_btn").addClass('hidden');
                $("#close_btn").removeClass('hidden');
                $("#port_details").removeClass('hidden');
            });

            $("#discount_btn").click(function() {
                $("#discount_body").toggle();
            });

            getPorts();
            $('input[type="checkbox"]').click(function(){
                priceCalculator();
            });

            $('input[type="radio"]').click(function () {
                priceCalculator();
            });

            $(".btn-refresh").click(function(){
                $.ajax({
                    type:'GET',
                    url:'/refresh_captcha',
                    success:function(data){
                        $(".captcha span").html(data.captcha);
                    }
                });
            });
            // Timer
            htimer()
        })

        // calculator
        $('#location').change(function(){
            // alert($(this).val());
            getPorts();
        });

        // timer start
        function htimer() {
            var hours = $("#rhours").text();
            var minutes = $("#rminutes").text();
            var seconds = $("#rseconds").text();

            // var hours = 0
            // var minutes = 0
            // var seconds = 10

            var hold_timer = setInterval(() => {

                seconds--;
                if (seconds < 0) {
                    seconds = 59;
                    minutes--
                }
                if (minutes < 0) {
                    minutes = 59;
                    hours--
                }
                if (hours < 0) {
                    hours = 0;
                    minutes = 0;
                    seconds = 0;
                    clearInterval(hold_timer);
                    return;
                }

                // console.log("hours: " + hours + " minutes:" + minutes + " seconds:" + seconds);

                if (hours < 10) {
                    thours = "0" + hours;
                    $("#rhours").text(thours);
                } else {
                    $("#rhours").text(hours);
                }

                if (minutes < 10) {
                    tminutes = "0" + minutes;
                    $("#rminutes").text(tminutes);
                } else {
                    $("#rminutes").text(minutes);
                }

                if (seconds < 10) {
                    seconds = "0" + seconds;
                }
                $("#rseconds").text(seconds);

            }, 1000);
        }
        // timer end

        function getPorts(){
            var countryId = $('#location').val();

            axios.get('/api/ports/'+countryId)
                .then(function(response){
                    var ports = response.data;
                    var portsLength = ports.length;
                    $("#ports-table").empty();
                    if(portsLength > 0){
                        $("#port-city").html(ports[0].name)
                        $("#from-city").html('From '+ports[0].name+' Port To')
                        for(let i = 0; i < portsLength; i++){
                            $("#ports-table").append(
                                `<div class="bg-blue-200 row p-2">
                                    <div class="port col-4 col-sm-4">
                                        <label for="port${ports[i].id}" class="text-sm color-black">
                                            <input type="radio" name="desport" onclick="priceCalculator()" id="port${ports[i].id}" value="${ports[i].amount}" data-insurance="${ports[i].insurance}" data-inspection="${ports[i].inspection}" data-warranty="${ports[i].warranty}" data-certificate="${ports[i].certificate}" checked>
                                            ${ports[i].name}
                                        </label>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <p class="text-center text-sm color-black">pick up at port (RORO)</p>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <p class="text-danger text-right text-sm">USD ${ports[i].amount}</p>
                                    </div>
                                </div>`
                            )
                        }
                    }else{
                        $("#ports-table").empty();
                        $("#port-city").html('')
                        $("#from-city").html('')
                    }
                    priceCalculator();
                });
        }

        function priceCalculator(){
            var productPrice = $("#prod_price").val();
            var checkedPort = $("input[name='desport']:checked").val();

            var totalPrice = parseInt(productPrice) + parseInt(checkedPort);

            if($("#marine").prop("checked") == true){
                totalPrice += parseInt($("input[name='desport']:checked").data('insurance'));
            }

            if($("#sgwar").prop("checked") == true){
                totalPrice += parseInt($("input[name='desport']:checked").data('warranty'));
            }

            if($("#sginsp").prop("checked") == true){
                totalPrice += parseInt($("input[name='desport']:checked").data('inspection'));
            }

            $("#totalEstimate").html(totalPrice);
            // console.log(totalPrice);
        }
    </script>
@endpush
