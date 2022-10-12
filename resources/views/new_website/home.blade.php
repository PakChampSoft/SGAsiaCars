@extends('new_layouts.main')

@push('title')
<title> {{ $pagedata->seo_title}}</title>
@endpush

@push('meta')
<meta name="description" content="{{ $pagedata? $pagedata->meta_description: "" }}">
<meta name="keywords" content="{{ $pagedata? $pagedata->meta_keywords: "" }}">
<meta name="yandex-verification" content="7e9fa5ac18bd5237" />
@endpush

@section('content')
    <section id="main-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-sm-12 d-none d-xl-block">
                    @include('new_includes.search-left-side-bar')
                </div>
                <div class="col-md-8 col-lg-10 col-xl-8 col-sm-12 order-3 order-xl-12 mb-5">
                    <!-- SEARCH FOR CARS FORM -->
                    <form action="{{ route('landing.stocklist') }}" id="custom_search_form">
                        <div class="row gray-box border-bottom-black" style="padding: 10px">
                            <div class="col-md-12 search-box-prl">
                                <h1 class="text-sm p-1 text-dark-black font-bold">SEARCH FOR CARS <span class="text-red-600"
                                  id="result_count"></span></h1>
                              </div>
                            <div class="col-md-3 search-box-prl">
                                <label class="text-sm text-dark-black" for="vehicle_maker">Maker</label>
                                <select name="maker" id="vehicle_maker" class="gray-bg py-0 rounded w-full filter_s">
                                    <option value="" selected="">Maker</option>
                                    @forelse (session('companies') as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }} ({{ $company->products_count }})</option>
                                    @empty
                                        <option value="" disabled>No Companies Found</option>
                                    @endforelse

                                </select>
                            </div>
                            <div class="col-md-3 search-box-prl">
                                <label class="text-sm text-dark-black" for="vehicle_type">Type</label>
                                <select name="type" class="gray-bg py-0 rounded w-full filter_s">
                                    <option value="" selected="" disabled="">Type</option>
                                    @forelse (session('types') as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @empty
                                        <option value="" disabled>No Types Found</option>
                                    @endforelse

                                </select>
                            </div>
                            <div class="col-md-3 search-box-prl">
                                <label class="text-sm text-dark-black" for="vehicle_color">Color</label>
                                <select name="color" class="gray-bg py-0 rounded w-full filter_s">
                                    <option value="" selected="">Color</option>
                                    @forelse (session('colors') as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @empty
                                        <option value="" disabled>No Colors Found</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-3 search-box-prl">
                                <label class="text-sm text-dark-black" for="vehicle_fuel">Fuel</label>
                                <select name="fuel" id="fuel" class="py-0 rounded w-full filter_s">
                                    <option value="" selected>FUEL</option>
                                    <option value="Petrol">Petrol</option>
                                    <option value="Hybrid(Petrol)">Hybrid(Petrol)</option>
                                    <option value="Diesel">Diesel</option>
                                </select>
                            </div>
                            @php
                                $years = ['2000','2001','2002','2002','2003','2004','2005','2006','2007','2008','2009','2010','2011','2012','2013','2014','2015','2016','2017','2018','2019','2020','2021'];
                            @endphp
                            <div class="col-md-3 search-box-prl">
                                <label class="text-sm text-dark-black" for="vehicl_year_from">Year From</label>
                                <select name="year_from" id="vehicl_year_from" class="py-0 rounded w-full filter_s">
                                    <option value="" selected="">YEAR FROM</option>
                                    @forelse ($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @empty
                                        <option value="" disabled>No Year Found</option>
                                    @endforelse

                                </select>
                            </div>
                            <div class="col-md-3 search-box-prl">
                                <label class="text-sm text-dark-black" for="vehicl_year_from">Year To</label>
                                <select name="year_from" id="vehicl_year_from" class="py-0 rounded w-full filter_s">
                                    <option value="" selected="">YEAR FROM</option>
                                    @forelse ($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @empty
                                        <option value="" disabled>No Year Found</option>
                                    @endforelse

                                </select>
                            </div>
                            @php
                                $enginesize = ['700', '1000', '1500', '1800', '2000', '2500', '3000', '4000'];
                            @endphp
                            <div class="col-md-3 search-box-prl">
                                <label class="text-sm text-dark-black" for="enginecc_from">Engine From</label>
                                <select name="enginecc_from" id="enginecc_from" class="py-0 rounded w-full filter_s">
                                    <option value="" selected="">ENGINE CC</option>
                                    @forelse ($enginesize as $cc)
                                        <option value="{{$cc}}">{{$cc}} CC</option>
                                    @empty
                                        <option value="" disabled>No Engine Sizes Found</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-3 search-box-prl">
                                <label class="text-sm text-dark-black" for="enginecc_from">Engine To</label>
                                <select name="enginecc_from" id="enginecc_from" class="py-0 rounded w-full filter_s">
                                    <option value="" selected="">ENGINE CC</option>
                                    @forelse ($enginesize as $cc)
                                        <option value="{{$cc}}">{{ $cc }} CC</option>
                                    @empty
                                        <option value="" disabled>No Engine Sizes Found</option>
                                    @endforelse
                                </select>
                            </div>

                        </div>
                        <div class="row gray-box pb-2 mb-3" style="padding: 10px">
                            <div class="col-md-2 search-box-prl">
                                <label class="text-sm text-dark-black" for="vehicle_drive_type">Drive Type</label>
                                <select name="drive_type" id="vehicle_drive_type" class="py-0 rounded w-full filter_s">
                                    <option value="" selected="">DRIVE TYPE</option>
                                    <option value="2WD">2WD</option>
                                    <option value="4WD">4WD</option>
                                </select>
                            </div>
                            <div class="col-md-3 search-box-prl">
                                <label class="text-sm text-dark-black" for="vehicle_transmission">Transmission</label>
                                <select name="transmission" id="vehicle_transmission" class="py-0 rounded w-full filter_s">
                                    <option value="" selected="">TRANSMISSION</option>
                                    <option value="Manual">Manual</option>
                                    <option value="CVT">CVT</option>
                                    <option value="Automatic">Automatic</option>
                                </select>
                            </div>
                            <div class="col-md-3 search-box-prl">
                                <label class="text-sm text-dark-black" for="vehicle_stock_country">Stock Country</label>
                                <select name="stock_country" id="vehicle_stock_country"
                                    class="py-0 rounded w-full filter_s">
                                    <option value="" selected="">STOCK COUNTRY</option>
                                    @forelse (session('countries') as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @empty
                                        <option value="" disabled>No Countries Found</option>
                                    @endforelse

                                </select>
                            </div>
                            <div class="col-md-4 search-box-prl text-center mt-3">
                                <div class="btns">
                                    <button type="submit" class="btn btn-search btn-search-padding mb-3"><span><i
                                                class="fa fa-search" aria-hidden="true"></i> Search</span></button>
                                    <a href="https://web.whatsapp.com/send/?phone=+66979714637" target="_blank">
                                        <button type="button" class="btn btn-success btn-whatsapp-padding mb-3"><span><i
                                                class="fa fa-search" aria-hidden="true"></i> Whatsapp</span></button>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </form>
                    <!--// SEARCH FOR CARS FORM -->

                    <div class="row brands gap-07 vissible-lg mt-1 mb-3" style="margin: 0px;">
                        <a href="{{ route('landing.stocklist', ['maker' => '1']) }}">
                            <div class="brand text-center border-gray" style="border-radius: 10px; padding: 0px 8px;">
                                <div class="h-12 overflow-hidden w-20">
                                    <img src="{{ asset('assets/images/toyota.png') }}" class="img-fluid" alt="">
                                </div>
                                <p class="text-sm text-dark-black font-bold padding-10">TOYOTA</p>
                            </div>
                        </a>
                        <a href="{{ route('landing.stocklist', ['maker' => '8']) }}">
                            <div class="brand text-center border-gray" style="border-radius: 10px; padding: 0px 8px;">
                                <div class="h-12 overflow-hidden w-20">
                                    <img src="{{ asset('assets/images/nissan.png') }}" class="img-fluid" alt="">
                                </div>
                                <p class="text-sm text-dark-black font-bold padding-10">NISSAN</p>
                            </div>
                        </a>
                        <a href="{{ route('landing.stocklist', ['maker' => '21']) }}">
                            <div class="brand text-center border-gray" style="border-radius: 10px; padding: 0px 8px;">
                                <div class="h-12 overflow-hidden w-20">
                                    <img src="{{ asset('assets/images/isuzu.png') }}" class="img-fluid" alt="">
                                </div>
                                <p class="text-sm text-dark-black font-bold padding-10">ISUZU</p>
                            </div>
                        </a>
                        <a href="{{ route('landing.stocklist', ['maker' => '5']) }}">
                            <div class="brand text-center border-gray" style=" border-radius: 10px; padding: 0px 8px;">
                                <div class="h-12 overflow-hidden w-20">
                                    <img src="{{ asset('assets/images/mistashi.png') }}" class="img-fluid" alt="">
                                </div>
                                <p class="text-sm text-dark-black font-bold padding-10">MITSUBISHI</p>
                            </div>
                        </a>
                        <a href="{{ route('landing.stocklist', ['maker' => '9']) }}">
                            <div class="brand text-center border-gray" style="border-radius: 10px; padding: 0px 8px;">
                                <div class="h-12 overflow-hidden w-20">
                                    <img src="{{ asset('assets/images/ford.png') }}" class="img-fluid" alt="">
                                </div>
                                <p class="text-sm text-dark-black font-bold padding-10">FORD</p>
                            </div>
                        </a>
                        <a href="{{ route('landing.stocklist', ['maker' => '33']) }}">
                            <div class="brand text-center border-gray" style="border-radius: 10px; padding: 0px 8px;">
                                <div class="h-12 overflow-hidden w-20">
                                    <img src="{{ asset('assets/images/cheverlot.png') }}" class="img-fluid" alt="">
                                </div>
                                <p class="text-sm text-dark-black font-bold padding-10">CHEVERLOT</p>
                            </div>
                        </a>
                        <a href="{{ route('landing.stocklist', ['maker' => '7']) }}">
                            <div class="brand text-center border-gray" style="border-radius: 10px; padding: 0px 12px;">
                                <div class="h-12 overflow-hidden w-20">
                                    <img src="{{ asset('assets/images/mazda.png') }}" class="img-fluid" alt="">
                                </div>
                                <p class="text-sm text-dark-black font-bold padding-10">MAZDA</p>
                            </div>
                        </a>
                    </div>
                    <!-- VEHICLES PICTURES -->
                    <div class="row d-none d-xl-block" style="margin: 0px;">
                        <div class="grid grid-cols-3 space-x-1 justify-around">
                            <div class="col-span-2 space-y-1">
                                <div class="flex gap-1">
                                    <div class="w-5/12 h-auto">
                                        <a href="#">
                                            <img src="{{ asset('assets/images/1519857.png') }}"
                                                class="w-full h-full img-fluid" alt="main_banner"
                                                style="padding-bottom: 4px;">
                                        </a>
                                    </div>
                                    <div class="w-7/12 h-auto">
                                        <a href="#">
                                            <img src="{{ asset('assets/images/215-2152977_toyota-hilux-2021-model.png') }}"
                                                class="w-full h-full img-fluid" alt="main_banner"
                                                style="padding-bottom: 4px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <div class="w-7/12 h-auto">
                                        <a href="#">
                                            <img src="{{ asset('assets/images/concept-toyota-hilux-2017-wallpaper-preview.png') }}"
                                                class="w-full h-full height-120  img-fluid" alt="main_banner">
                                        </a>
                                    </div>
                                    <div class="w-5/12 h-auto">
                                        <a href="#">
                                            <img src="{{ asset('assets/images/toyota-toyota-hilux-car-pickup-vehicle-hd-wallpaper-preview.png') }}"
                                                class="w-full h-full height-120  img-fluid" alt="main_banner">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="flex flex-col gap-1">
                                    <div class="w-full h-60">
                                        <a href="#">
                                            <img src="{{ asset('assets/images/2021-toyota-hilux-exterior-5.png') }}"
                                                class="w-full h-full  img-fluid" alt="main_banner"
                                                style="padding-top:4px; padding-left:4px;height: 205px;">
                                        </a>
                                    </div>
                                    <div class="w-full h-full">
                                        <a href="#">
                                            <img src="{{ asset('assets/images/toyota-hilux-front-angle-low-view-422131.png') }}"
                                                class="h-36 w-full  img-fluid" alt="main_banner" style="padding-left: 4px;">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- VEHICLES AREAS STARTED -->
                    <div class="row mt-4">
                        <h1 class="text-dark-black gray2-bg py-1 px-2 font-bold text-lg border-r mr-3 ml-3">New Arrivals</h1><br>
                        <hr class="border-black mr-3 ml-3">

                        @forelse ($newArrivals as $product)
                            <div class="col-sm-4 col-lg-2 mb-4">
                                <a
                                    href="{{ strtolower(route('landing.detail', [$product->vcompany->name,$product->drive_type ?: 'Both',Str::slug($product->vtype->name, '_'),$product->engine_cc,$product->ref_no])) }}">
                                    <div class="card">
                                        <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                                        <div class="card-body dark-blue-bg padding-5">
                                            <h6 class="text-white font-12 text-center font-weight-bold">
                                                {{ $product->vcompany->name . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}
                                            </h6>
                                        </div>
                                        <div class="">
                                            <h1 class="text-xs text-center py-1">
                                                {{ $product->manufacture_date . ' | ' . $product->transmission }}</h1>
                                            <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                                        </div>
                                        <div class="gray-box">
                                            <h5 class="text-dark-black font-bold text-center font-12">USD
                                                {{ $product->price }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @empty
                            <div class="col-sm-12 col-lg-12 mb-4">
                                <h4 class="float-left text-sm font-bold">No Products Found</h4>
                            </div>
                        @endforelse
                        <div class="col-sm-12">
                            <a href="{{ route('landing.stocklist') }}">
                                <button type="button" class="font-bold text-red-600 btn-see-more float-right" >see
                                    more...</button>
                            </a>
                        </div>
                    </div>
                    <!-- // VEHICLES AREAS -->

                    <!-- FEATURED -->
                    <div class="row mt-4">
                        <h1 class="text-dark-black gray2-bg py-1 px-2 font-bold text-lg border-r mr-3 ml-3">Featured</h1><br>
                        <hr class="border-black mr-3 ml-3">
                        @forelse ($featured as $product)
                            <div class="col-sm-4 col-lg-2 mb-4">
                                <a
                                    href="{{ strtolower(route('landing.detail', [$product->vcompany->name,$product->drive_type ?: 'Both',Str::slug($product->vtype->name, '_'),$product->engine_cc,$product->ref_no])) }}">
                                    <div class="card">
                                        <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                                        <div class="card-body dark-blue-bg padding-5">
                                            <h6 class="text-white font-12 text-center font-weight-bold">
                                                {{ $product->vcompany->name . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}
                                            </h6>
                                        </div>
                                        <div class="">
                                            <h1 class="text-xs text-center py-1">
                                                {{ $product->manufacture_date . ' | ' . $product->transmission }}</h1>
                                            <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                                        </div>
                                        <div class="gray-box">
                                            <h5 class="text-dark-black font-bold text-center font-12">USD
                                                {{ $product->price }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @empty
                            <div class="col-sm-12 col-lg-12 mb-4">
                                <h4 class="float-left text-sm font-bold">No Products Found</h4>
                            </div>
                        @endforelse
                        <br>
                        <div class="col-sm-12">
                            <a href="{{ route('landing.stocklist', ['featured' => '1']) }}">
                                <button type="button" class="font-bold text-red-600 btn-see-more float-right" >see
                                    more...</button>
                            </a>
                        </div>
                    </div>
                    <!-- // FEATURED -->

                    <!-- DISCOUNTED DEALS -->
                    <div class="row mt-4">
                        <h1 class="text-dark-black gray2-bg py-1 px-2 font-bold text-lg border-r mr-3 ml-3">Discounted</h1><br>
                        <hr class="border-black mr-3 ml-3">
                        @forelse ($discounted as $product)
                            <div class="col-sm-4 col-lg-2 mb-4">
                                <a
                                    href="{{ strtolower(route('landing.detail', [$product->vcompany->name,$product->drive_type ?: 'Both',Str::slug($product->vtype->name, '_'),$product->engine_cc,$product->ref_no])) }}">
                                    <div class="card">
                                        <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                                        <div class="card-body dark-blue-bg padding-5">
                                            <h6 class="text-white font-12 text-center font-weight-bold">
                                                {{ $product->vcompany->name . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}
                                            </h6>
                                        </div>
                                        <div class="">
                                            <h1 class="text-xs text-center py-1">
                                                {{ $product->manufacture_date . ' | ' . $product->transmission }}</h1>
                                            <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                                        </div>
                                        <div class="gray-box">
                                            <h5 class="text-dark-black font-bold text-center font-12">USD
                                                {{ $product->price }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @empty
                            <div class="col-sm-12 col-lg-12 mb-4">
                                <h4 class="float-left text-sm font-bold">No Products Found</h4>
                            </div>
                        @endforelse
                        <br>
                        <div class="col-sm-12">
                            <a href="{{ route('landing.stocklist', ['deal' => '6']) }}">
                                <button type="button" class="font-bold text-red-600 btn-see-more float-right" >see
                                    more...</button>
                            </a>
                        </div>
                    </div>
                    <!-- // DISCOUNTED DEALS -->
                    <!-- BEST DEALS -->
                    <div class="row mt-4">
                        <h1 class="text-dark-black gray2-bg py-1 px-2 font-bold text-lg border-r mr-3 ml-3">Best Deals</h1><br>
                        <hr class="border-black mr-3 ml-3">
                        @forelse ($bestdeals as $product)
                            <div class="col-sm-4 col-lg-2 mb-4">
                                <a
                                    href="{{ strtolower(route('landing.detail', [$product->vcompany->name,$product->drive_type ?: 'Both',Str::slug($product->vtype->name, '_'),$product->engine_cc,$product->ref_no])) }}">
                                    <div class="card">
                                        <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                                        <div class="card-body dark-blue-bg padding-5">
                                            <h6 class="text-white font-12 text-center font-weight-bold">
                                                {{ $product->vcompany->name . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}
                                            </h6>
                                        </div>
                                        <div class="">
                                            <h1 class="text-xs text-center py-1">
                                                {{ $product->manufacture_date . ' | ' . $product->transmission }}</h1>
                                            <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                                        </div>
                                        <div class="gray-box">
                                            <h5 class="text-dark-black font-bold text-center font-12">USD
                                                {{ $product->price }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @empty
                            <div class="col-sm-12 col-lg-12 mb-4">
                                <h4 class="float-left text-sm font-bold">No Products Found</h4>
                            </div>
                        @endforelse
                        <div class="col-sm-12">
                            <a href="{{ route('landing.stocklist', ['deal' => '7']) }}">
                                <button type="button" class="font-bold text-red-600 btn-see-more float-right" >see
                                    more...</button>
                            </a>
                        </div>
                    </div>
                    <!-- // BEST DEALS -->
                    <!-- PREMINUM VIP DEALS -->
                    <div class="row mt-4">
                        <h1 class="text-dark-black gray2-bg py-1 px-2 font-bold text-lg border-r ml-3 mr-3">Premium VIP</h1><br>
                        <hr class="border-black ml-3 mr-3">
                        @forelse ($premium as $product)
                            <div class="col-sm-4 col-lg-2 mb-4">
                                <a
                                    href="{{ strtolower(route('landing.detail', [$product->vcompany->name,$product->drive_type ?: 'Both',Str::slug($product->vtype->name, '_'),$product->engine_cc,$product->ref_no])) }}">
                                    <div class="card">
                                        <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                                        <div class="card-body dark-blue-bg padding-5">
                                            <h6 class="text-white font-12 text-center font-weight-bold">
                                                {{ $product->vcompany->name . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}
                                            </h6>
                                        </div>
                                        <div class="">
                                            <h1 class="text-xs text-center py-1">
                                                {{ $product->manufacture_date . ' | ' . $product->transmission }}</h1>
                                            <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                                        </div>
                                        <div class="gray-box">
                                            <h5 class="text-dark-black font-bold text-center font-12">USD
                                                {{ $product->price }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @empty
                            <div class="col-sm-12 col-lg-12 mb-4">
                                <h4 class="float-left text-sm font-bold">No Products Found</h4>
                            </div>
                        @endforelse
                        <div class="col-sm-12">
                            <a href="{{ route('landing.stocklist', ['deal' => '8']) }}">
                                <button type="button" class="font-bold text-red-600 btn-see-more float-right" >see
                                    more...</button>
                            </a>
                        </div>
                    </div>

                    <!-- // PREMINUM VIP DEALS -->
                </div>
                <div class="col-md-4 col-lg-2 col-xl-2 col-sm-12 order-2 order-xl-12">
                    @include('new_includes.right-side-signup')
                </div>
            </div>
            <!-- CONTACT US INFORMATION TABS -->
            @include('new_includes.contact-us-info')
            <!-- // CONTACT US INFORMATION TABS -->

    </section>
@endsection

@push('whatsappbtn')
    {{-- whatsapp button --}}
    <a href="https://web.whatsapp.com/send/?phone=+66979714637" target="_blank" class="bg-green-600 text-white h-16 w-16 border-green-800 text-center fixed bottom-0 left-1 z-10">
        <div class="d-flex align-items-center padding-rl">
            <i class="lab la-whatsapp text-4xl"></i>
            <i class="text-white">Send Message</i>
        </div>

    </a>
    {{-- end whatsapp button --}}
@endpush

@push('js')
 <!-- Messenger Chat plugin Code -->
 {{-- <div id="fb-root"></div>
 <!-- Your Chat Plugin code -->
 <div id="fb-customer-chat" class="fb-customerchat">
 </div>
 <script>
   var chatbox = document.getElementById('fb-customer-chat');
   chatbox.setAttribute("page_id", "107320988450655");
   chatbox.setAttribute("attribution", "biz_inbox");
 </script>

 <!-- Your SDK code -->
 <script>
   window.fbAsyncInit = function() {
     FB.init({
       xfbml            : true,
       version          : 'v12.0'
     });
   };

   (function(d, s, id) {
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) return;
     js = d.createElement(s); js.id = id;
     js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
 </script> --}}
 <!-- // Messenger Chat plugin Code -->

    {{-- Range Slider --}}
    <script src="{{ asset('assets/js/range-slider.js') }}"></script>
    {{-- MAIN JAVASCRIPT FOR FILTERS --}}
    <script>
        $(document).ready(function(){
            $(".filter_s").change(function(){
                filterStock();
            });

            function filterStock(){
                let form = $("#custom_search_form");
                let dataString = form.serialize();
                console.log(dataString);
                axios.get('api/stock/quantity?'+dataString)
                        .then(function(response){
                            // console.log(response);
                            $("#result_count").html("("+response.data+") Results");
                        })
                        .catch(function(error){
                            $("#result_count").html('N/A');
                        });
            }
        })
    </script>
@endpush
