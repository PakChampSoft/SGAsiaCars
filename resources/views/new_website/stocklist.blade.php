@extends('new_layouts.main')
@section('content')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- MAIN SECTION -->
    <section id="main-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 d-none d-md-block d-lg-block d-xl-block">
                    @include('new_includes.search-left-side-bar')
                </div>
                <div class="col-lg-10 col-md-8 mb-5">
                    <!-- FILTER SEARCH FORM -->
                    <form action="{{ route('landing.stocklist') }}" id="stock_filter_form">
                        <div class="row"
                            style="width: 100%; background: #f1f1f1; height: fit-content; margin-left: 0px;">
                            <div class="col-md-12 mb-3">
                                <h6 class="font-bold mt-3 text-dark-black">SEARCH FOR VEHICLE</h6>
                            </div>
                            <div class="col-lg-3 padding-rl-5">
                                <div class="form-group">
                                    <select class="form-control border-gray-input text-xs filter_s" name="maker" id="maker">
                                        <option value="">MAKER (ALL)</option>
                                        @forelse (session('companies') as $company)
                                            <option {{ $company->id == request()->maker ? 'selected' : '' }}
                                                value="{{ $company->id }}">{{ $company->name }}
                                                ({{ $company->products_count }})
                                            </option>
                                        @empty
                                            <option value="" disabled>No Maker Found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 padding-rl-5">
                                <div class="form-group">
                                    <select class="form-control border-gray-input text-xs filter_s" name="type" id="type">
                                        <option value="">BODY TYPE</option>
                                        @forelse (session('types') as $type)
                                            <option {{ request()->type == $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">{{ $type->name }}</option>
                                        @empty
                                            <option value="" disabled>No Body Type Found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-md-5 padding-rl-5">
                                        <div class="form-group">
                                            @php
                                                $prices = ['500', '750', '1000', '1500', '2000', '2500', '3000', '3500', '4000', '4500', '5000', '5500', '6000', '7000', '8000', '9000', '1000', '15000', '20000'];
                                            @endphp
                                            <select class="form-control border-gray-input text-xs filter_s pr-4"
                                                name="min_price" id="min_price">
                                                <option value="" class="text-truncate">MIN PRICE</option>
                                                @forelse ($prices as $price)
                                                    <option {{ request()->min_price == $price ? 'selected' : '' }}
                                                        value="{{ $price }}">{{ $price }}</option>
                                                @empty
                                                    <option value="" disabled>No Min Price Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 padding-rl-5 text-center">
                                        <b class="v-middle">~</b>
                                    </div>
                                    <div class="col-md-5 padding-rl-5">
                                        <div class="form-group">
                                            <select class="form-control border-gray-input text-xs filter_s pr-4"
                                                name="max_price" id="max_price">
                                                <option value="">MAX PRICE</option>
                                                @forelse ($prices as $price)
                                                    <option {{ request()->max_price == $price ? 'selected' : '' }}
                                                        value="{{ $price }}">{{ $price }}</option>
                                                @empty
                                                    <option value="" disabled>No Max Price Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 padding-rl-5">
                                <div class="form-group">
                                    <select class="form-control border-gray-input text-xs filter_s" name="fuel" id="fuel">
                                        <option value="" selected>FUEL (ANY)</option>
                                        <option {{ request()->fuel == 'PETROL' ? 'selected' : '' }} value="PETROL">PETROL</option>
                                        <option {{ request()->fuel == 'HYBRID(PETROL)' ? 'selected' : '' }} value="HYBRID(PETROL)">
                                            HYBRID(PETROL)</option>
                                        <option {{ request()->fuel == 'DIESEL' ? 'selected' : '' }} value="DIESEL">DIESEL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 padding-rl-5">
                                <div class="form-group">
                                    <select class="form-control border-gray-input text-xs filter_s" name="steering"
                                        id="steering">
                                        <option value="">STEERING</option>
                                        <option {{ request()->steering == 'RIGHT' ? 'selected' : '' }} value="RIGHT">
                                            RIGHT</option>
                                        <option {{ request()->steering == 'LEFT' ? 'selected' : '' }} value="LEFT">LEFT
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 padding-rl-5">
                                <div class="form-group">
                                    <select class="form-control border-gray-input text-xs filter_s" name="transmission"
                                        id="transmission">
                                        <option value="">TRANSMISSION</option>
                                        <option {{ request()->transmission == 'AUTOMATIC' ? 'selected' : '' }}
                                            value="AUTOMATIC">AUTOMATIC</option>
                                        <option {{ request()->transmission == 'MANUAL' ? 'selected' : '' }}
                                            value="MANUAL">MANUAL</option>
                                        <option {{ request()->transmission == 'CVT' ? 'selected' : '' }} value="CVT">CVT
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 padding-rl-5">
                                <div class="form-group">

                                    <select class="form-control border-gray-input text-xs filter_s" name="drive_type" id="drive_type">
                                        <option value="" selected="">DRIVE TYPE</option>
                                        <option value="2WD">2WD</option>
                                        <option value="4WD">4WD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-md-5 padding-rl-5">
                                        <div class="form-group">
                                            @php
                                                $years = ['2000', '2001', '2002', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021'];
                                            @endphp
                                            <select class="form-control border-gray-input text-xs filter_s pr-4"
                                                name="year_from" id="year_from">
                                                <option value="">MIN YEAR</option>
                                                @forelse ($years as $year)
                                                    <option {{ request()->year_from == $year ? 'selected' : '' }}
                                                        value="{{ $year }}">{{ $year }}</option>
                                                @empty
                                                    <option value="" disabled>No Year From Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 padding-rl-5 text-center">
                                        <b class="v-middle">~</b>
                                    </div>
                                    <div class="col-md-5 padding-rl-5">
                                        <div class="form-group">
                                            <select class="form-control border-gray-input text-xs filter_s pr-4" name="year_to" id="year_to">
                                                <option value="">MAX YEAR</option>
                                                @forelse ($years as $year)
                                                    <option {{ request()->year_from == $year ? 'selected' : '' }}
                                                        value="{{ $year }}">{{ $year }}</option>
                                                @empty
                                                    <option value="" disabled>No Year To Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-md-5 padding-rl-5">
                                        <div class="form-group">
                                            @php
                                                $mileages = ['50000', '75000', '100000', '150000', '200000', '300000'];
                                            @endphp
                                            <select class="form-control border-gray-input text-xs filter_s pr-4"
                                                name="min_mileage" id="min_mileage">
                                                <option value="">MIN MILAGE</option>
                                                @forelse ($mileages as $mileage)
                                                    <option {{ request()->min_mileage == $mileage ? 'selected' : '' }}
                                                        value="{{ $mileage }}">{{ $mileage }}</option>
                                                @empty
                                                    <option value="" disabled>No Min Milage Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 padding-rl-5 text-center">
                                        <b class="v-middle">~</b>
                                    </div>
                                    <div class="col-md-5 padding-rl-5">
                                        <div class="form-group">
                                            <select class="form-control border-gray-input text-xs filter_s pr-4"
                                                name="max_mileage" id="max_mileage">
                                                <option value="">MAX MILAGE</option>
                                                @foreach ($mileages as $mileage)
                                                    <option {{ request()->max_mileage == $mileage ? 'selected' : '' }}
                                                        value="{{ $mileage }}">{{ $mileage }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-md-5 padding-rl-5">
                                        <div class="form-group">
                                            @php
                                                $enginecss = ['700', '1000', '1500', '1800', '2000', '2500', '3000', '4000'];
                                            @endphp
                                            <select class="form-control border-gray-input text-xs filter_s pr-4" name="enginecc_from" id="enginecc_from">
                                                <option value="">MIN ENGINE</option>
                                                @foreach ($enginecss as $cc)
                                                    <option {{ request()->enginecc_from == $cc ? 'selected' : '' }}
                                                        value="{{ $cc }}">{{ $cc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 padding-rl-5 text-center">
                                        <b class="v-middle">~</b>
                                    </div>
                                    <div class="col-md-5 padding-rl-5">
                                        <div class="form-group">
                                            <select class="form-control border-gray-input text-xs filter_s pr-4" name="enginecc_to"
                                                id="enginecc_to">
                                                <option value="">MAX ENGINE</option>
                                                @foreach ($enginecss as $cc)
                                                    <option {{ request()->enginecc_to == $cc ? 'selected' : '' }}
                                                        value="{{ $cc }}">{{ $cc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <button type="button" id="show_filters_btn"
                                    class="w-full dark-blue-bg  text-white py-2 rounded text-xs border-0">SHOW MORE
                                    OPTIONS <i class="las la-angle-down"></i></button>
                                <button type="button" id="hide_filters_btn"
                                    class="hidden w-full dark-blue-bg  text-white py-2 rounded text-xs border-0">HIDE
                                    MORE OPTIONS <i class="las la-angle-up"></i></button>
                            </div>
                            <div class="col-lg-3">

                            </div>
                            <!-- HIDDEN FILTERS -->
                            <div id="hidden_filters" class="row hidden mb-5 w-full m-auto">
                                <div class="col-lg-3 padding-rl-5">
                                    <div class="form-group">
                                        <select class="form-control border-gray-input text-xs filter_s" name="color" id="color">
                                            <option value="">COLOR</option>
                                            @foreach (session('colors') as $color)
                                                <option {{ request()->color == $color->id ? 'selected' : '' }}
                                                    value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 padding-rl-5">
                                    <div class="form-group">
                                        <select class="form-control border-gray-input text-xs filter_s" name="stock_country" id="stock_country">
                                            <option value="">STOCK COUNTRY</option>
                                            @foreach (session('countries') as $country)
                                                <option {{ request()->stock_country == $country->id ? 'selected' : '' }}
                                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-md-5 padding-rl-5">
                                            <div class="form-group">
                                                <input type="number" class="form-control text-xs filter_i" name="min_seats"
                                                    id="min_seats" placeholder="MIN SEATS">
                                            </div>
                                        </div>
                                        <div class="col-md-2 padding-rl-5 text-center">
                                            <b class="v-middle">~</b>
                                        </div>
                                        <div class="col-md-5 padding-rl-5">
                                            <div class="form-group">
                                                <input type="number" class="form-control text-xs filter_i" name="max_seats"
                                                    id="max_seats" placeholder="MAX SEATS">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">

                                </div>
                                @forelse ($accessories as $accessory)
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                                        <div class="form-check">
                                            <input class="form-check-input filter_c"
                                                {{ in_array($accessory->id, request()->asscs ?? []) ? 'checked' : '' }}
                                                type="checkbox" name="asscs[]" value="{{ $accessory->id }}"
                                                id="assc-{{ $accessory->id }}">
                                            <label class="form-check-label text-sm color-black" for="for="
                                                assc-{{ $accessory->id }}"">
                                                {{ $accessory->name }}
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                                        <div class="form-check">
                                            <h6>No Accessory Found</h6>
                                        </div>
                                    </div>
                                @endforelse

                            </div>
                            <!-- // HIDDEN FILTERS -->
                            @forelse ($deals as $deal)
                                <div class="col-xs-6 col-lg-3 col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input filter_c"
                                            {{ in_array($deal->id, request()->deals ?? []) ? 'checked' : '' }}
                                            type="checkbox" name="deals[]" id="deal-{{ $deal->id }}"
                                            value="{{ $deal->id }}">

                                        <label class="form-check-label text-danger font-bold"
                                            for="deal-{{ $deal->id }}">
                                            {{ $deal->title }}
                                        </label>
                                    </div>
                                </div>
                            @empty
                            @endforelse


                            <div class="col-md-12 mt-2 mb-2">
                                <p class="font-bold text-xl color-black"><span
                                        id="stock_quantity">{{ $products->total() }}</span> <span
                                        class="text-sm font-normal color-black">items match the criteria</span></p>
                            </div>
                            <div class="col-md-8 mt-2 mb-2">
                                <button class="dark-blue-bg text-white py-2 px-8 rounded text-lg search-filter-button"
                                    type="submit"><i class="las la-search"></i> SEARCH</button>
                            </div>
                        </div>
                    </form>
                    <!-- // FILTER SERACH FORM -->
                    <!-- View vehicles shipping from -->
                    <div class="d-none d-xl-block">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p class="text-xs">View vehicles shipping from:</p>
                            </div>
                            <div class="col-md-7 countries">
                                <a href="{{ route('landing.stocklist') }}"
                                    class="bg-gray-300 flex items-center text-xs border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5 color-black">ALL</a>
                                <a href="{{ route('landing.stocklist', ['stock_country' => '213']) }}"
                                    class="bg-gray-300 flex gap-x-1 items-center text-xs  border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5 color-black"><img
                                        src="{{ asset('/images/flags/thailand.png') }}" width="15px">
                                    <span>THAILAND</span></a>
                                <a href="{{ route('landing.stocklist', ['stock_country' => '225']) }}"
                                    class="bg-gray-300 flex gap-x-1 items-center text-xs  border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5 color-black"><img
                                        src="{{ asset('/images/flags/united-arab-emirates.png') }}" width="15px">
                                    <span>UAE</span></a>
                                {{-- <a href="{{ route('landing.stocklist', ['stock_country' => '109']) }}"
                                    class="bg-gray-300 flex gap-x-1 items-center text-xs  border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 color-black"><img
                                        src="{{ asset('/images/flags/japan.png') }}" width="15px"> <span>JAPAN</span></a>
                                <a href="{{ route('landing.stocklist', ['stock_country' => '192']) }}"
                                    class="bg-gray-300 flex gap-x-1 items-center text-xs  border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5 color-black"><img
                                        src="{{ asset('/images/flags/singapore.png') }}" width="15px">
                                    <span>SINGAPOR</span></a>
                                <a href="{{ route('landing.stocklist', ['stock_country' => '226']) }}"
                                    class="bg-gray-300 flex gap-x-1 items-center text-xs  border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5 color-black"><img
                                        src="{{ asset('/images/flags/united-kingdom.png') }}" width="15px">
                                    <span>UK</span></a>
                                <a href="{{ route('landing.stocklist', ['stock_country' => '115']) }}"
                                    class="bg-gray-300 flex gap-x-1 items-center text-xs  border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5 color-black"><img
                                        src="{{ asset('/images/flags/south-korea.png') }}" width="15px">
                                    <span>KOREA</span></a>
                                <a href="{{ route('landing.stocklist', ['stock_country' => '244']) }}"
                                    class="bg-gray-300 flex gap-x-1 items-center text-xs  border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5 color-black"><img
                                        src="{{ asset('/images/flags/united-states.png') }}" width="15px">
                                    <span>USA</span></a> --}}
                            </div>
                            <div class="col-md-5">
                                <form method="GET" action="{{ route('landing.stocklist') }}">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select class="bg-gray-300 rounded text-xs py-1.5 w-full border-blue-bg " name="port_country"
                                                id="port_country" required="">
                                                <option value="">Select Country</option>
                                                @forelse (session('countries') as $country)
                                                    <option
                                                        {{ request()->port_country == $country->id ? 'selected' : '' }}
                                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                                @empty
                                                    <option value="">No Country Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="bg-gray-300 rounded text-xs py-1.5 w-full border-blue-bg " name="country_ports"
                                                id="country_ports" required="">
                                                <option value="">Port</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button
                                                class="py-1.5 dark-blue-bg px-1.5 text-white rounded text-xs w-full calculate-btn border-blue-bg ">Calculate</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- // View vehicles shipping from -->
                    <!-- STOCKLIST PREVIEW -->
                    <!-- //STOCKLIST PREVIEW -->
                    <div class="row m-auto">
                        <div class="col-sm-12 pl-0">
                            <h4 class="text-xl font-bold text-dark-black mt-3">STOCKLIST ({{ $products->total() }})</h4>
                            <hr>
                        </div>
                    </div>

                    <div class="row m-auto">
                        @forelse ($products as $product)
                        <?php
                        $company=$product->vcompany->name?str_replace(' ', '', $product->vcompany->name):'';
                        $type=$product->vtype->name?str_replace(' ', '',$product->vtype->name):'';
                        $drivetype=$product->drive_type?str_replace(' ', '', $product->drive_type):'';
                        $engine_cc=$product->engine_cc;

                        $ref_no=$product->ref_no;


                        $url=$type.'-'.$drivetype.'-'.$engine_cc.'-'.$ref_no;
                        ?>
                            <div class="col-lg-2 pr-0 pl-0">
                                <div class="card">
                                    <a href="{{ route('seodetail',['company'=> $company,'url'=> $url]) }}">
                                        <img class="card-img-top position-relative {{ $product->sold != 0 ? 'opacity-50' : '' }}"
                                            src="{{ asset($product->main_image_name) }}" alt="Card image cap">
                                        @if ($product->sold == 1)
                                            <img class="card-img-top position-absolute opacity-50"
                                                src="{{ asset('images/sold2.png') }}" alt="sold" style="left:0px">
                                        @endif
                                        @if ($product->sold == 3)
                                            <img class="card-img-top position-absolute opacity-50"
                                                src="{{ asset('images/hold.png') }}" alt="hold" style="left: 0px">
                                        @endif
                                    </a>
                                    <div class="card-body gray-box" style="padding: 12px;">
                                        <h6 class=" text-center gray-box font-bold">Ref No. {{ $product->ref_no ?? '' }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 pl-1 pr-0">
                                <div class="col-md-12 pl-0">
                                    <a href="{{ strtolower(route('landing.detail', [Str::slug($product->vcompany->name, '_'),$product->drive_type ?: 'Both',Str::slug($product->vtype->name, '_'),$product->engine_cc,$product->ref_no])) }}"
                                        class="text-xl text-dark-black font-bold">{{ $product->manufacture_date ?? '' }}
                                        {{ $product->vcompany->name ?? '' }} {{ $product->vtype->name ?? '' }}
                                        {{ $product->drive_type ?? '' }}</a>
                                </div>
                                <div class="col-md-12 pl-0 pr-0">
                                    <div class="grid grid-cols-5">
                                        <div class="text-center text-sm border-right">
                                            <p class="text-sm">Mileage</p>
                                            <p class="text-dark-black text-lg-stock-info font-bold">
                                                {{ $product->mileage ?? 'N/A' }} </p>
                                        </div>
                                        <div class="text-center text-sm border-right">
                                            <p class="text-sm">Year</p>
                                            <p class="text-dark-black text-lg-stock-info font-bold">
                                                {{ $product->manufacture_date ?? 'N/A' }}</p>
                                        </div>
                                        <div class="text-center text-sm border-right">
                                            <p class="text-sm">Engine</p>
                                            <p class="text-dark-black text-lg-stock-info font-bold">
                                                {{ $product->engine_cc }}</p>
                                        </div>
                                        <div class="text-center text-sm border-right">
                                            <p class="text-sm">Trans.</p>
                                            <p class="text-dark-black text-lg-stock-info font-bold">
                                                {{ $product->transmission }}</p>
                                        </div>
                                        <div class="text-center text-sm">
                                            <p class="text-sm">Location</p>
                                            <p class="text-dark-black text-lg-stock-info font-bold">
                                                {{ $product->vcountry->name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 pl-0 pr-0">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="text-xs"><b>Model Code</b></td>
                                            <td class="text-xs">DAA-NKE165G</td>
                                            <td class="text-xs"><b>Steering</b></td>
                                            <td class="text-xs">{{ $product->steering }}</td>
                                            <td class="text-xs"><b>Fuel</b></td>
                                            <td class="text-xs">{{ $product->fuel_type }}</td>
                                            <td class="text-xs"><b>Seats</b></td>
                                            <td class="text-xs">{{ $product->seats?? "-" }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-xs"><b>Engine code</b></td>
                                            <td class="text-xs">1KZ</td>
                                            <td class="text-xs"><b>Color</b></td>
                                            <td class="text-xs">{{ $product->vcolor->name ?? 'N/A' }}</td>
                                            <td class="text-xs"><b>Drive</b></td>
                                            <td class="text-xs">{{ $product->drive_type }}</td>
                                            <td class="text-xs"><b>Doors</b></td>
                                            <td class="text-xs">{{ $product->no_of_doors?? "-" }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12 pl-0 pr-0">
                                    @php
                                        $tempFeatures = explode(',', $product->accessories);
                                        $features = array_slice($tempFeatures, 0, 6);
                                    @endphp
                                    <div class="flex divide-solid divide-x-2 text-xs-parts blue-text overflow-hidden">
                                        @foreach ($accessories as $accessory)
                                            @if (in_array($accessory->id, $features))
                                                <div class="px-2 text-center border-right">{{ $accessory->name }}</div>
                                            @endif
                                        @endforeach
                                        @if (count($tempFeatures) > 6)
                                            <div class="px-2 text-center">
                                                <a href="{{ strtolower(route('landing.detail', [$product->vcompany->name,$product->drive_type ?: 'Both',Str::slug($product->vtype->name, '_'),$product->engine_cc,$product->ref_no])) }}"
                                                    class="font-bold">and more</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 mb-2 mt-3">
                                <!-- product status 0 for available products -->
                                @if ($product->sold == 0)
                                    <div class="price">
                                        <div class="row m-auto">
                                            <div class="col-xs-7">
                                                <p class="text-gray-400 text-sm">Price</p>
                                            </div>
                                            <div class="col-xs-5">
                                                <p class="text-red-600 text-lg font-bold text-right">USD {{ $product->price }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row m-auto">
                                            <div class="col-xs-7">
                                                <p class="text-gray-400 text-sm">Total Price</p>
                                            </div>
                                            <div class="col-xs-5">
                                                @if ($port != null)
                                                    <p class="text-red-600 text-lg text-right" id="cif_price">USD {{ $product->price + $port->amount + $port->certificate + $port->insurance + $port->inspection }}</p>
                                                @else
                                                    <p class="text-red-600 text-lg text-right" id="cif_price">USD {{ $product->price }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-12 text-right pl-0 pr-0 mb-2">
                                                <p class="text-gray-500 text-sm ml-auto" id="cif_port">CIF To {{ $port != null ? $port->name : 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-12 pl-0 pr-0">
                                                <button
                                                    class="w-full dark-blue-bg text-white py-1 text-xl rounded inquiry_btn inquiry-button"
                                                    data-toggle="modal"
                                                    data-target="#inquiry_model_{{ $product->id }}"><i
                                                        class="las la-envelope"></i> INQUIRY</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($product->sold == 1)
                                    <!-- status 1 for sold products -->
                                    <div class="sold mt-3">
                                        <button class="bg-green-500 text-white py-1 text-xl rounded mb-3 sold-btn"><i
                                                class="las la-money-bill-wave"></i> Sold</button>
                                        <a href="{{ route('pre-order', $product->id) }}">
                                            <button
                                                class="text-white bg-blue-600 py-1 text-center text-xl rounded btn-preorder">Preorder</button>
                                        </a>
                                    </div>
                                @endif

                                @if ($product->sold == 2)
                                    <!-- status 2 for in-offer products  -->
                                    <div class="in-offer mt-4">
                                        <button class="bg-gray-500 text-white py-1 text-xl rounded btn-in-offer"><i
                                                class="las la-money-check-alt"></i> In Offer</button>
                                    </div>
                                @endif

                                @if ($product->sold == 3)
                                    <!-- product status 3 for on-hold products -->
                                    <div class="hold-btn">
                                        <button class="bg-yellow-500 text-white py-1 text-xl rounded on-hold-btn mt-5"><i
                                                class="las la-hand-holding-usd"></i> On Hold</button>
                                    </div>
                                @endif

                            </div>
                            <div class="col-sm-12 pl-0">
                                <hr class="gray">
                            </div>
                        @empty
                            <div class="col-sm-12">
                                <h3 class="text-center">No Products Found</h3>
                            </div>
                        @endforelse

                        @if ($products!="")
                            <div class="col-sm-4 mt-1">Showing
                                {{ ($products->currentpage() - 1) * $products->perpage() + 1 }} to
                                {{ $products->currentpage() * $products->perpage() }}
                                of {{ $products->total() }} results
                            </div>
                        @endif

                        <div class="col-sm-8">
                            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                </div>
            </div>

            <!-- CONTACT US INFORMATION TABS -->
            @include('new_includes.contact-us-info')
            <!-- // CONTACT US INFORMATION TABS -->

        </div>
    </section>
    <!-- // MAIN SECTION -->
@endsection
@section('modal')
    @foreach ($products as $product)
        <!-- Modal -->
        @if ($product->sold == 0)
            <div class="modal fade" id="inquiry_model_{{ $product->id }}" tabindex="-1" role="dialog"
                aria-labelledby="inquiry_model_{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="inquiry_form" method="POST" action="{{ route('landing.quote-request') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="inquiry_model_{{ $product->id }}">INQUIRY (FREE
                                    QUOTE)</h5>
                                <button type="button" class="close" data-id="{{ $product->id }}"
                                    data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <img src="{{ asset($product->main_image_name) }}" alt="" class="img-fluid text-center"
                                            style="width:70%">
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="align-middle text-sm-center text-lg-left mt-8">
                                            {{ $product->vcompany->name ?? '' }} {{ $product->vtype->name }}
                                            ({{ $product->ref_no }})
                                        </h4>
                                    </div>
                                    <div class="col-md-12 pl-5 pr-5 mt-3">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">Year</td>
                                                    <td>{{ $product->manufacture_date ?? '' }}</td>
                                                    <td class="font-weight-bold">Final Country</td>
                                                    <td>{{ $stockCountry->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Engine</td>
                                                    <td>{{ $product->engine_cc ?? '' }}</td>
                                                    <td class="font-weight-bold">Port / City</td>
                                                    <td>KARACHI</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Mileage</td>
                                                    <td>{{ $product->mileage ?? '' }}</td>
                                                    <td class="font-weight-bold">Insurance</td>
                                                    <td>YES</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Steering</td>
                                                    <td>{{ $product->steering ?? '' }}</td>
                                                    <td class="font-weight-bold">Total Price</td>
                                                    @if ($port != null)
                                                        <td>USD
                                                            {{ $product->price + $port->amount + $port->certificate + $port->insurance + $port->inspection }}
                                                        </td>
                                                    @else
                                                        <td>USD {{ $product->price }}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Trans</td>
                                                    <td>{{ $product->transmission ?? '' }}</td>
                                                    <td class="font-weight-bold">Warranty</td>
                                                    <td>YES</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Location</td>
                                                    <td>{{ $product->vcountry->name ?? '' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 pl-5 pr-5">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Your Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Full Name" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="city">City <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="city" id="city"
                                                    placeholder="Full Name" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="address">Address <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="address" id="address"
                                                    placeholder="Street, Town, Province" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="tel">Telephone <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="tel" id="tel"
                                                    placeholder="Cell Phone or Telephone No." required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="country">Country <span class="text-danger">*</span></label>
                                                <select name="country" id="country" class="form-control" required>
                                                    @foreach (session('countries') as $country)
                                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="Discount Coupon">Discount Coupon <span
                                                        class="text-danger"></span></label>
                                                <div class="btn-group w-full" role="group" aria-label="Basic example">
                                                    <input type="text" class="form-control" name="discount_coupon" id="discount_coupon"
                                                        placeholder="Optional">
                                                    <button type="button" class="btn btn-secondary">Apply</button>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="recaptcha">Captcha <span class="text-danger">*</span></label>
                                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                                <label class="form-check-label" for="gridCheck">
                                                    Receive news, coupons and special deals
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-envelope"></i> GET A PRICE QUOTE
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <!-- // MODELS -->
    @endforeach
@endsection

@push('js')
    {{-- Range Slider --}}
    <script src="{{ asset('assets/js/range-slider.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#show_filters_btn").click(function() {
                $("#show_filters_btn").addClass('hidden');
                $("#hide_filters_btn").removeClass('hidden');

                $("#hidden_filters").removeClass('hidden');
            });

            $("#hide_filters_btn").click(function() {
                $("#hide_filters_btn").addClass('hidden');
                $("#show_filters_btn").removeClass('hidden');

                $("#hidden_filters").addClass('hidden');
            });

            $(".inquiry_btn").click(function() {
                var id = $(this).data('id');
                $("#inquiry_model_" + id).removeClass("hidden")
                $("#inquiry_model_" + id).addClass("z-10");

            })

            $(".inquiry_close_btn").click(function() {
                var id = $(this).data('id')
                $("#inquiry_model_" + id).addClass("hidden");
                $("#inquiry_model_" + id).removeClass("z-10")
            })

            // change default port
            $("#port_country").change(function() {
                // alert('country changed');
                let c = $(this).val();
                axios.get('/api/ports/' + c).then(function(response) {
                    let ports = response.data;
                    $("#country_ports").empty();
                    for (let i = 0; i < ports.length; i++) {
                        $("#country_ports").append(
                            `<option value=${ports[i].id}>${ports[i].name}</option>`
                        )
                    }
                })
            });
            // calculatorPorts();

            $(".filter_s").change(function() {
                filterStock();
            });

            $(".filter_i").change(function() {
                filterStock();
            });

            $(".filter_c").change(function() {
                filterStock();
            });

            function filterStock() {
                form = $("#stock_filter_form");
                dataString = form.serialize();

                axios.get('api/stock/quantity?' + dataString)
                    .then(function(response) {
                        console.log(response);
                        $("#stock_quantity").html(response.data);
                    })
                    .catch(function(error) {
                        $("#stock_quantity").html('N/A');
                    });
            }

        });

        // function calculatorPorts() {
        //     axios.get('/api/ports/' + $("#port_country").val()).then(function(response) {
        //         let ports = response.data;
        //         $("#country_ports").empty();
        //         for (let i = 0; i < ports.length; i++) {
        //             $("#country_ports").append(
        //                 `<option value=${ports[i].id}>${ports[i].name}</option>`
        //             )
        //         }
        //     })
        // }
    </script>
@endpush
