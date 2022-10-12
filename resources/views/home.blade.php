@extends('layouts.main')
@push('title')
<title> {{ $pagedata->seo_title}}</title>
@endpush
@push('meta')
<meta name="description" content="{{ $pagedata? $pagedata->meta_description: "" }}">
<meta name="keywords" content="{{ $pagedata? $pagedata->meta_keywords: "" }}">
<meta name="yandex-verification" content="7e9fa5ac18bd5237" />
@endpush
@push('style')
<link rel="stylesheet" href="{{ asset('css/jquery.range.css') }}">

{{-- <style>

.companies input[type=radio]{
    display: none;
}

.companies input[type=radio] + label:hover {
    border: 1px solid blue;
}

.companies input[type=radio]:checked + label {
    border: 1px solid blue;
}

</style> --}}
@endpush


@section('content')
    <div class="grid grid-cols-12 mt-4 gap-1">
        <div id="custom-search" class="col-span-2">
            {{-- side bar here --}}
            @include('includes.sidebar')
        </div>
        <div class="col-span-10">
            <div class="grid grid-cols-6 mb-4 gap-1">
                {{-- custom search and banner image area --}}
                <div class="col-span-5 w-full">
                    {{-- custom search --}}
                    <h1 class="text-sm gray-box p-1 dark-blue-text font-bold">SEARCH FOR CARS <span class="text-red-600" id="result_count"></span></h1>
                    <form id="custom_search" action="{{ route('landing.stocklist') }}">
                        <div class="gray-box shadow-lg py-1 px-1">
                            <div id="l1" class="grid grid-cols-4 gap-1">
                                <div class="frm-grp">
                                    <label class="text-sm dark-blue-text" for="vehicle_maker">Maker</label>
                                    <select name="maker" id="vehicle_maker" class="gray-bg py-0 rounded w-full filter_s">
                                        <option value="" selected>Maker</option>
                                        @forelse (session('companies') as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }} ({{ $company->products_count }})</option>
                                        @empty
                                            <option value="" disabled>No Companies Found</option>
                                        @endforelse
                                    </select>
                                </div>
                                {{-- <div class="frm-grp">
                                    <label class="text-sm dark-blue-text" for="vehicle_model">Model</label>
                                    <select name="model" id="vehicle_model" class="gray-bg py-0 rounded w-full filter_s">
                                        <option value="" selected>Model</option>
                                        @forelse (session('models') as $model)
                                            <option value="{{ $model->id }}">{{ $model->name }}({{ $model->products_count }})</option>
                                        @empty
                                            <option value="" disabled>No Models Found</option>
                                        @endforelse
                                    </select>
                                </div> --}}
                                <div class="frm-grp">
                                    <label class="text-sm dark-blue-text" for="vehicle_type">Type</label>
                                    <select name="type" class="gray-bg py-0 rounded w-full filter_s">
                                        <option value="" selected disabled>Type</option>
                                        @forelse (session('types') as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @empty
                                            <option value="" disabled>No Types Found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="frm-grp">
                                    <label class="text-sm dark-blue-text" for="vehicle_color">Color</label>
                                    <select name="color" class="gray-bg py-0 rounded w-full filter_s">
                                        <option value="" selected>Color</option>
                                        @forelse (session('colors') as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @empty
                                            <option value="" disabled>No Colors Found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="frm-grp">
                                    <label class="text-sm dark-blue-text" for="vehicle_fuel">Fuel</label>
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
                                <div class="frm-grp">
                                    <label class="text-sm dark-blue-text" for="vehicl_year_from">Year From</label>
                                    <select name="year_from" id="vehicl_year_from" class="py-0 rounded w-full filter_s">
                                        <option value="" selected>YEAR FROM</option>
                                        @forelse ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @empty
                                            <option value="" disabled>No Year Found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="frm-grp">
                                    <label class="text-sm dark-blue-text" for="vehicle_year_to">Year To</label>
                                    <select name="year_to" id="vehicle_year_to" class="py-0 rounded w-full filter_s">
                                        <option value="" selected>YEAR TO</option>
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
                                <div class="frm-grp">
                                    <label class="text-sm dark-blue-text" for="enginecc_from">Engine From</label>
                                    <select name="enginecc_from" id="enginecc_from" class="py-0 rounded w-full filter_s">
                                        <option value="" selected>ENGINE CC</option>
                                        @forelse ($enginesize as $cc)
                                            <option value="{{ $cc }}">{{ $cc }} CC</option>
                                        @empty
                                            <option value="" disabled>No Engine Sizes Found</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="frm-grp">
                                    <label class="text-sm dark-blue-text" for="enginecc_to">Engine To</label>
                                    <select name="enginecc_to" id="enginecc_to" class="py-0 rounded w-full filter_s">
                                        <option value="" selected>ENGINE CC</option>
                                        @forelse ($enginesize as $cc)
                                            <option value="{{ $cc }}">{{ $cc }} CC</option>
                                        @empty
                                            <option value="" disabled>No Engine Sizes Found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <hr class="my-1 border-black">
                            <div id="l3" class="grid grid-cols-12 gap-1">
                                <div class="frm-grp col-span-2">
                                    <label class="text-sm dark-blue-text" for="vehicle_drive_type">DRIVE TYPE</label>
                                    <select name="drive_type" id="vehicle_drive_type" class="py-0 rounded w-full filter_s">
                                        <option value="" selected>DRIVE TYPE</option>
                                        <option value="2WD">2WD</option>
                                        <option value="4WD">4WD</option>
                                    </select>
                                </div>
                                <div class="frm-grp col-span-3">
                                    <label class="text-sm dark-blue-text" for="vehicle_transmission">Transmission</label>
                                    <select name="transmission" id="vehicle_transmission" class="py-0 rounded w-full filter_s">
                                        <option value="" selected>TRANSMISSION</option>
                                        <option value="Manual">Manual</option>
                                        <option value="CVT">CVT</option>
                                        <option value="Automatic">Automatic</option>
                                    </select>
                                </div>
                                <div class="frm-grp col-span-3">
                                    <label class="text-sm dark-blue-text" for="vehicle_stock_country">Stock Country</label>
                                    <select name="stock_country" id="vehicle_stock_country" class="py-0 rounded w-full filter_s">
                                        <option value="" selected>STOCK COUNTRY</option>
                                        @forelse (session('countries') as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @empty
                                            <option value="" disabled>No Countries Found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="frm-grp mt-auto col-span-2">
                                    <button type="submit" class="dark-blue-bg text-white text-sm px-2 w-full h-10 py-0 rounded cursor-pointer">
                                        <span class="flex items-center justify-center gap-2"><i class="las la-search" style="font-size: 20px;"></i>Search</span>
                                    </button>
                                </div>
                                <div class="frm-grp mt-auto col-span-2">
                                    <a href="https://api.whatsapp.com/send/?phone=+66917869096" target="_blank" class="bg-green-600 inline-block text-white w-full h-10 text-sm px-2 py-0 rounded cursor-pointer">
                                        <div class="w-full h-full flex items-center justify-center gap-2 my-auto">
                                            <i class="lab la-whatsapp" style="font-size: 20px;"></i>
                                            <p>Whatsapp</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- featured companies --}}
                    <div id="l2" class="flex gap-2 items-center justify-around my-2 companies">
                        <a href="{{ route('landing.stocklist', ['maker' => '1']) }}" class="flex flex-col gap-1 items-center px-2 py-1 bg-white border border-gray-300 rounded-md cursor-pointer comp">
                            <div class="h-12 overflow-hidden w-20">
                                <img src="{{ asset('images/assets/toyota-car-logo-6968@2x.png') }}" alt="company logo" class="w-full h-full object-contain">
                            </div>
                            <p class="text-sm dark-blue-text font-bold">TOYOTA</p>
                        </a>

                        <a href="{{ route('landing.stocklist', ['maker' => '8']) }}" class="flex flex-col gap-1 items-center px-2 py-1 bg-white border border-gray-300 rounded-md cursor-pointer comp">
                            <div class="h-12 overflow-hidden w-20">
                                <img src="{{ asset('images/assets/nissan-logo-703@2x.png') }}" alt="company logo" class="w-full h-full object-contain">
                            </div>
                            <p class="text-sm dark-blue-text font-bold">NISSAN</p>
                        </a>

                        <a href="{{ route('landing.stocklist', ['maker' => '21']) }}" class="flex flex-col gap-1 items-center px-2 py-1 bg-white border border-gray-300 rounded-md cursor-pointer comp">
                            <div class="h-12 overflow-hidden w-20">
                                <img src="{{ asset('images/assets/Isuzu-logo-1991-3840x2160@2x.png') }}" alt="company logo" class="w-full h-full object-contain">
                            </div>
                            <p class="text-sm dark-blue-text font-bold">ISUZU</p>
                        </a>

                        <a href="{{ route('landing.stocklist', ['maker' => '5']) }}" class="flex flex-col gap-1 items-center px-2 py-1 bg-white border border-gray-300 rounded-md cursor-pointer comp">
                            <div class="h-12 overflow-hidden w-20">
                                <img src="{{ asset('images/assets/PinClipart.com_3g-eclipse-supercharger-kit_354296@2x.png') }}" alt="company logo" class="w-full h-full object-contain">
                            </div>
                            <p class="text-sm dark-blue-text font-bold">MITSUBISHI</p>
                        </a>

                        <a href="{{ route('landing.stocklist', ['maker' => '9']) }}" class="flex flex-col gap-1 items-center px-2 py-1 bg-white border border-gray-300 rounded-md cursor-pointer comp">
                            <div class="h-12 overflow-hidden w-20">
                                <img src="{{ asset('images/assets/Ford-Motor-Company-Logo@2x.png') }}" alt="company logo" class="w-full h-full object-contain">
                            </div>
                            <p class="text-sm dark-blue-text font-bold">FORD</p>
                        </a>

                        <a href="{{ route('landing.stocklist', ['maker' => '33']) }}" class="flex flex-col gap-1 items-center px-2 py-1 bg-white border border-gray-300 rounded-md cursor-pointer comp">
                            <div class="h-12 overflow-hidden w-20">
                                <img src="{{ asset('images/assets/chevrolet-logo@2x.png') }}" alt="company logo" class="w-full h-full object-contain">
                            </div>
                            <p class="text-sm dark-blue-text font-bold">CHEVERLOT</p>
                        </a>

                        <a href="{{ route('landing.stocklist', ['maker' => '7']) }}" class="flex flex-col gap-1 items-center px-2 py-1 bg-white border border-gray-300 rounded-md cursor-pointer comp">
                            <div class="h-12 overflow-hidden w-20">
                                <img src="{{ asset('images/assets/mazda_PNG86.png') }}" alt="company logo" class="w-full h-full object-contain">
                            </div>
                            <p class="text-sm dark-blue-text font-bold">MAZDA</p>
                        </a>
                    </div>
                    {{-- <img src="{{ asset('images/vigos.png') }}" class="w-full" alt="banner"> --}}
                    <div class="grid grid-cols-3 space-x-1 justify-around">
                        <div class="col-span-2 space-y-1">
                            <div class="flex gap-1">
                                <div class="w-5/12 h-auto">
                                    <a href="#">
                                        <img src="{{ asset('images/assets/1519857.png') }}" class="w-full h-full" alt="main_banner">
                                    </a>
                                </div>
                                <div class="w-7/12 h-auto">
                                    <a href="#">
                                        <img src="{{ asset('images/assets/215-2152977_toyota-hilux-2021-model.png') }}" class="w-full h-full" alt="main_banner">
                                    </a>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <div class="w-7/12 h-auto">
                                    <a href="#">
                                        <img src="{{ asset('images/assets/concept-toyota-hilux-2017-wallpaper-preview.png') }}" class="w-full h-full" alt="main_banner">
                                    </a>
                                </div>
                                <div class="w-5/12 h-auto">
                                    <a href="#">
                                        <img src="{{ asset('images/assets/toyota-toyota-hilux-car-pickup-vehicle-hd-wallpaper-preview.png') }}" class="w-full h-full" alt="main_banner">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <div class="flex flex-col gap-1">
                                <div class="w-full h-60">
                                    <a href="#">
                                        <img src="{{ asset('images/assets/2021-toyota-hilux-exterior-5.png') }}" class="w-full h-full" alt="main_banner">
                                    </a>
                                </div>
                                <div class="w-full h-full">
                                    <a href="#">
                                        <img src="{{ asset('images/assets/toyota-hilux-front-angle-low-view-422131.png') }}" class="h-36 w-full" alt="main_banner">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full gray-box shadow-lg">
                    <h1 class="dark-blue-bg py-1 text-white text-sm text-center font-bold">
                        <a href="#" class="text-xs px-1">CREATE ACCOUNT<i class="las la-user text-lg"></i></a>
                    </h1>
                    <form action="#" class="flex flex-col gap-2 mt-4 px-2">
                            <input type="text" placeholder="YOUR NAME" class="gray-box px-0 border-0 border-b border-gray-300 focus:outline-none focus:ring-0">
                            <input type="text" placeholder="YOUR EMAIL" class="gray-box px-0 border-0 border-b border-gray-300 focus:outline-none focus:ring-0">
                            <input type="text" placeholder="YOUR PHONE" class="gray-box px-0 border-0 border-b border-gray-300 focus:outline-none focus:ring-0">
                            <select name="user_country" class="gray-box px-0 border-0 border-b border-gray-300 focus:outline-none focus:ring-0" id="user_country">
                                <option value="" disabled selected>Country</option>
                                @forelse (session('countries') as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @empty
                                    <option value="" disabled>No Countries Found</option>
                                @endforelse
                            </select>
                            <div class="w-full mt-4 flex justify-center">
                                <input type="submit" value="LOGIN" class="dark-blue-bg text-white px-6">
                            </div>
                            {{-- <textarea name="nam" id="nam" rows="1" placeholder="YOUR NAME" class="w-full  border-0 border-b-2"></textarea> --}}
                    </form>
                    <div class="w-full mt-8">
                        <div class="w-full h-full">
                            <h1 class="dark-blue-text text-sm text-center">Shipping Scheduling</h1>
                            <a href="{{ asset('docs/schdule.pdf') }}" target="_blank">
                                {{-- <img src="{{ asset('images/assets/wp6391291.png') }}" class="w-full h-60 object-cover"> --}}
                                {{-- <img src="https://via.placeholder.com/162x240.png" class="w-full h-60 object-cover"> --}}
                                <img src="{{ asset('images/shipping.png') }}" class="w-full h-auto" alt="shipping">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-6 gap-1">
                <div class="col-span-5 mb-8">
                    {{-- new arrivals --}}
                    <div class="flex mb-1">
                        <h1 class="dark-blue-text gray2-bg py-1 px-2 font-bold text-lg border-r border-black">New Arrivals</h1>
                    </div>
                    <hr class="border border-black">
                    <div class="grid grid-cols-6 gap-2 mt-6">
                        @forelse ($newArrivals as $product)
                        {{-- car card --}}
                        <a href="{{ strtolower(route('landing.detail', [$product->vcompany->name,  $product->drive_type ?: 'Both', Str::slug($product->vtype->name, '_'), $product->engine_cc, $product->ref_no])) }}">
                            <div class="card flex flex-col gap-2">
                                <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                                <div class="py-2 gray-bg align-middle">
                                    <h1 class="dark-blue-bg text-white font-bold text-center">{{ $product->vcompany->name  . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}</h1>
                                    <div class="px-4 bg-white">
                                        <h1 class="text-xs text-center py-1">{{ $product->manufacture_date . ' | ' . $product->transmission  }}</h1>
                                        <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                                    </div>
                                    <h1 class="dark-blue-text font-bold text-center py-1">USD {{ $product->price }}</h1>
                                </div>
                            </div>
                        </a>
                        @empty
                            <div class="flex items-center justify-center">
                                <h1 class="text-sm font-bold text-center">No Products Found</h1>
                            </div>
                        @endforelse
                    </div>
                    <div class="my-1 flex justify-end">
                        <a class="font-bold text-red-600" href="{{ route('landing.stocklist') }}">see more...</a>
                    </div>

                    {{-- Featured cars --}}
                    <div class="mb-8">
                        <div class="flex mb-1">
                            <h1 class="dark-blue-text gray2-bg py-1 px-2 font-bold text-lg border-r border-black">Featured</h1>
                        </div>
                        <hr class="border border-black">
                        <div class="grid grid-cols-6 gap-2 mt-6">
                            @forelse ($featured as $product)
                            {{-- car card --}}
                            <a href="{{ strtolower(route('landing.detail', [$product->vcompany->name,  $product->drive_type ?: 'Both', Str::slug($product->vtype->name, '_'), $product->engine_cc, $product->ref_no])) }}">
                                <div class="card flex flex-col gap-2">
                                    <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                                    <div class="py-2 gray-bg align-middle">
                                        <h1 class="dark-blue-bg text-white font-bold text-center">{{ $product->vcompany->name . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}</h1>
                                        <div class="px-4 bg-white">
                                            <h1 class="text-xs text-center py-1">{{ $product->manufacture_date . ' | ' . $product->transmission  }}</h1>
                                            <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                                        </div>
                                        <h1 class="dark-blue-text font-bold text-center py-1">USD {{ $product->price }}</h1>
                                    </div>
                                </div>
                            </a>
                            @empty
                                <div class="flex items-center justify-center">
                                    <h1 class="text-sm font-bold text-center">No Products Found</h1>
                                </div>
                            @endforelse
                        </div>
                        <div class="my-1 flex justify-end">
                            <a class="font-bold text-red-600" href="{{ route('landing.stocklist', ['featured' => '1']) }}">see more...</a>
                        </div>
                    </div>

                    {{-- Discounted --}}
                    <div class="mb-8">
                        <div class="flex mb-1">
                            <h1 class="dark-blue-text gray2-bg py-1 px-2 font-bold text-lg border-r border-black">Discounted</h1>
                        </div>
                        <hr class="border border-black">
                        <div class="grid grid-cols-6 gap-2 mt-6">
                            @forelse ($discounted as $product)
                            {{-- car card --}}
                            <a href="{{ strtolower(route('landing.detail', [$product->vcompany->name,  $product->drive_type ?: 'Both', Str::slug($product->vtype->name, '_'), $product->engine_cc, $product->ref_no])) }}">
                                <div class="card flex flex-col gap-2">
                                    <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                                    <div class="py-2 gray-bg align-middle">
                                        <h1 class="dark-blue-bg text-white font-bold text-center">{{ $product->vcompany->name . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}</h1>
                                        <div class="px-4 bg-white">
                                            <h1 class="text-xs text-center py-1">{{ $product->manufacture_date . ' | ' . $product->transmission  }}</h1>
                                            <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                                        </div>
                                        <h1 class="dark-blue-text font-bold text-center py-1">USD {{ $product->price }}</h1>
                                    </div>
                                </div>
                            </a>
                            @empty
                                <div class="flex items-center justify-center">
                                    <h1 class="text-sm font-bold text-center">No Products Found</h1>
                                </div>
                            @endforelse
                        </div>
                        <div class="my-1 flex justify-end">
                            <a class="font-bold text-red-600" href="{{ route('landing.stocklist', ['deal' => '6']) }}">see more...</a>
                        </div>
                    </div>

                    {{-- Best Deals --}}
                    <div class="mb-8">
                        <div class="flex mb-1">
                            <h1 class="dark-blue-text gray2-bg py-1 px-2 font-bold text-lg border-r border-black">Best Deals</h1>
                        </div>
                        <hr class="border border-black">
                        <div class="grid grid-cols-6 gap-2 mt-6">
                            @forelse ($bestdeals as $product)
                            {{-- car card --}}
                            <a href="{{ strtolower(route('landing.detail', [$product->vcompany->name,  $product->drive_type ?: 'Both', Str::slug($product->vtype->name, '_'), $product->engine_cc, $product->ref_no])) }}">
                                <div class="card flex flex-col gap-2">
                                    <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                                    <div class="py-2 gray-bg align-middle">
                                        <h1 class="dark-blue-bg text-white font-bold text-center">{{ $product->vcompany->name  . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}</h1>
                                        <div class="px-4 bg-white">
                                            <h1 class="text-xs text-center py-1">{{ $product->manufacture_date . ' | ' . $product->transmission  }}</h1>
                                            <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                                        </div>
                                        <h1 class="dark-blue-text font-bold text-center py-1">USD {{ $product->price }}</h1>
                                    </div>
                                </div>
                            </a>
                            @empty
                                <div class="flex items-center justify-center">
                                    <h1 class="text-sm font-bold text-center">No Products Found</h1>
                                </div>
                            @endforelse
                        </div>
                        <div class="my-1 flex justify-end">
                            <a class="font-bold text-red-600" href="{{ route('landing.stocklist', ['deal' => '7']) }}">see more...</a>
                        </div>
                    </div>

                    {{-- Premium VIP --}}
                    <div class="mb-8">
                        <div class="flex mb-1">
                            <h1 class="dark-blue-text gray2-bg py-1 px-2 font-bold text-lg border-r border-black">Premium VIP</h1>
                        </div>
                        <hr class="border border-black">
                        <div class="grid grid-cols-6 gap-2 mt-6">
                            @forelse ($premium as $product)
                            {{-- car card --}}
                            <a href="{{ strtolower(route('landing.detail', [$product->vcompany->name,  $product->drive_type ?: 'Both', Str::slug($product->vtype->name, '_'), $product->engine_cc, $product->ref_no])) }}">
                                <div class="card flex flex-col gap-2">
                                    <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                                    <div class="py-2 gray-bg align-middle">
                                        <h1 class="dark-blue-bg text-white font-bold text-center">{{ $product->vcompany->name . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}</h1>
                                        <div class="px-4 bg-white">
                                            <h1 class="text-xs text-center py-1">{{ $product->manufacture_date . ' | ' . $product->transmission  }}</h1>
                                            <h1 class="text-center text-xs px-2 py-1">PRICE</h1>
                                        </div>
                                        <h1 class="dark-blue-text font-bold text-center py-1">USD {{ $product->price }}</h1>
                                    </div>
                                </div>
                            </a>
                            @empty
                                <div class="flex items-center justify-center">
                                    <h1 class="text-sm font-bold text-center">No Products Found</h1>
                                </div>
                            @endforelse
                        </div>
                        <div class="my-1 flex justify-end">
                            <a class="font-bold text-red-600" href="{{ route('landing.stocklist', ['deal' => '8']) }}">see more...</a>
                        </div>
                    </div>
                </div>
                {{-- span-1 second part --}}
                <div class="col-span-1">
                    {{-- banner ads here --}}
                    <div class="mb-4">
                        <a href="#">
                            {{-- <img src="{{ asset('images/assets/toyota-hilux-bruiser-2017-new-yn-1242x2688.png') }}" alt="" srcset=""> --}}
                            <img src="{{ asset('images/stocks/japan.jpgf') }}" alt="stock_banner">

                        </a>
                    </div>
                    <div class="mb-4">
                        <a href="#">
                            <img src="{{ asset('images/stocks/singapore.jpg') }}" alt="stock_banner">
                            {{-- <img src="{{ asset('images/assets/toyota-hilux-bruiser-2017-new-yn-1242x2688.png') }}" alt="" srcset=""> --}}
                        </a>
                    </div>
                    <div class="mb-4">
                        <!-- Your Chat plugin code -->
                        <div id="fb-customer-chat" class="fb-customerchat">
                        </div>
                    </div>
                    {{-- <div class="mb-4">
                        <a href="#">
                            <img src="https://via.placeholder.com/162x377.png">
                            <img src="{{ asset('images/assets/toyota-hilux-bruiser-2017-new-yn-1242x2688.png') }}" alt="" srcset="">
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- contact information --}}
    @include('includes.contact-info')

    {{-- whatsapp button --}}
    <a href="https://api.whatsapp.com/send/?phone=+66917869096" target="_blank" class="bg-green-600 text-white h-16 w-16 border border-green-800 rounded-full text-center fixed bottom-4 right-4 z-10">
        <i class="lab la-whatsapp text-4xl mt-3"></i>
    </a>
    {{-- end whatsapp button --}}
@endsection


@push('js')

    <!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>

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
    </script>

    <script>
        $(document).ready(function(){
            $(".filter_s").change(function(){
                filterStock();
            });

            $("#vehicle_maker").change(function(){
                let maker = $(this).val();
                // alert(maker);
                axios.get('api/models?company='+maker)
                        .then(function(response){
                            var models = response.data;
                            // console.log(models);
                            $("#vehicle_model").empty();
                            $("#vehicle_model").append('<option value="">Model</option>');
                            for(let i = 0; i < models.length; i++){
                                let html = `<option value=${models[i].id}>${models[i].name}(${models[i].products_count})</option>`;
                                // let op = document.createElement('option');
                                // op.value = models[i].id;
                                // op.html = models[i].name;
                                $("#vehicle_model").append(html);
                            }
                        })
            });

            function filterStock(){
                let form = $("#custom_search");
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
