@extends('layouts.main')

@section('content')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="grid grid-cols-12 gap-1 my-4">
        <div id="custom-search" class="col-span-2">
            {{-- side bar here --}}
            @include('includes.sidebar')
        </div>
        <div class="col-span-10">
            {{-- search bar --}}
            <form action="{{ route('landing.stocklist') }}" class="grid grid-cols-12 gap-x-4 gap-y-2 p-2 bg-blue-300"
                id="stock_filter_form">
                <div class="col-span-12">
                    <h1 class="text-white font-bold">SEARCH FOR VEHICLE</h1>
                </div>
                <div class="frm-grp col-span-3">
                    <select name="maker"
                        class="w-full rounded text-xs filter_s {{ request()->filled('maker') ? 'bg-blue-200' : '' }}">
                        <option value="">MAKER (ALL)</option>
                        @foreach (session('companies') as $company)
                            <option {{ $company->id == request()->maker ? 'selected' : '' }} value="{{ $company->id }}">
                                {{ $company->name }} ({{ $company->products_count }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="frm-grp col-span-3">
                    <select name="type"
                        class="w-full rounded text-xs filter_s {{ request()->filled('type') ? 'bg-blue-200' : '' }}">
                        <option value="">BODY TYPE</option>
                        @foreach (session('types') as $type)
                            <option {{ request()->type == $type->id ? 'selected' : '' }} value="{{ $type->id }}">
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="frm-grp col-span-3">
                    <select name="model" class="w-full rounded text-xs filter_s {{ request()->filled('model') ? 'bg-blue-200' : '' }}" >
                        <option value="">MODEL (ALL)</option>
                        @foreach (session('models') as $model)
                            <option {{ $model->id == request()->model ? 'selected' : '' }} value="{{ $model->id }}">{{ $model->name }} ({{ $model->products_count }})</option>
                        @endforeach
                    </select>
                </div> --}}
                {{-- <div class="frm-grp col-span-3">
                    <select name="model_code" class="w-full rounded text-xs" >
                        <option value="">MODEL CODE (ALL)</option>
                        <option value="">HONDA</option>
                        <option value="">SUZUKI</option>
                        <option value="">CHEVERLOT</option>
                        <option value="">KIA</option>
                    </select>
                </div> --}}
                <div class="frm-grp col-span-3">
                    <div class="grid grid-cols-12">
                        @php
                            $prices = ['500', '750', '1000', '1500', '2000', '2500', '3000', '3500', '4000', '4500', '5000', '5500', '6000', '7000', '8000', '9000', '1000', '15000', '20000'];
                        @endphp
                        <div class="col-span-5">
                            <select name="min_price"
                                class="w-full rounded text-xs filter_s {{ request()->filled('min_price') ? 'bg-blue-200' : '' }}">
                                <option value="">MIN PRICE</option>
                                @foreach ($prices as $price)
                                    <option {{ request()->min_price == $price ? 'selected' : '' }}
                                        value="{{ $price }}">{{ $price }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <h1 class="text-center">~</h1>
                        </div>
                        <div class="col-span-5">
                            <select name="max_price"
                                class="w-full rounded text-xs filter_s {{ request()->filled('max_price') ? 'bg-blue-200' : '' }}">
                                <option value="">MAX PRICE</option>
                                @foreach ($prices as $price)
                                    <option {{ request()->max_price == $price ? 'selected' : '' }}
                                        value="{{ $price }}">{{ $price }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="frm-grp col-span-3">
                    <select name="fuel"
                        class="w-full rounded text-xs filter_s {{ request()->filled('fuel') ? 'bg-blue-200' : '' }}">
                        <option value="" selected>FUEL (ANY)</option>
                        <option {{ request()->fuel == 'PETROL' ? 'selected' : '' }} value="PETROL">PETROL</option>
                        <option {{ request()->fuel == 'HYBRID(PETROL)' ? 'selected' : '' }} value="HYBRID(PETROL)">
                            HYBRID(PETROL)</option>
                        <option {{ request()->fuel == 'DIESEL' ? 'selected' : '' }} value="DIESEL">DIESEL</option>
                    </select>
                </div>
                <div class="frm-grp col-span-3">
                    <select name="steering"
                        class="w-full rounded text-xs filter_s {{ request()->filled('steering') ? 'bg-blue-200' : '' }}">
                        <option value="">STEERING</option>
                        <option {{ request()->steering == 'RIGHT' ? 'selected' : '' }} value="RIGHT">RIGHT</option>
                        <option {{ request()->steering == 'LEFT' ? 'selected' : '' }} value="LEFT">LEFT</option>
                    </select>
                </div>
                <div class="frm-grp col-span-3">
                    <select name="transmission"
                        class="w-full rounded text-xs filter_s {{ request()->filled('transmission') ? 'bg-blue-200' : '' }}">
                        <option value="">TRANSMISSION</option>
                        <option {{ request()->transmission == 'AUTOMATIC' ? 'selected' : '' }} value="AUTOMATIC">
                            AUTOMATIC</option>
                        <option {{ request()->transmission == 'MANUAL' ? 'selected' : '' }} value="MANUAL">MANUAL
                        </option>
                        <option {{ request()->transmission == 'CVT' ? 'selected' : '' }} value="CVT">CVT</option>
                    </select>
                </div>
                <div class="frm-grp col-span-3">
                    <div class="grid grid-cols-12">
                        @php
                            $years = ['2000', '2001', '2002', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021'];
                        @endphp
                        <div class="col-span-5">
                            <select name="year_from"
                                class="w-full rounded text-xs filter_s {{ request()->filled('year_from') ? 'bg-blue-200' : '' }}">
                                <option value="">MIN YEAR</option>
                                @foreach ($years as $year)
                                    <option {{ request()->year_from == $year ? 'selected' : '' }}
                                        value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <h1 class="text-center">~</h1>
                        </div>
                        <div class="col-span-5">
                            <select name="year_to"
                                class="w-full rounded text-xs filter_s {{ request()->filled('year_to') ? 'bg-blue-200' : '' }}">
                                <option value="">MAX YEAR</option>
                                @foreach ($years as $year)
                                    <option {{ request()->year_to == $year ? 'selected' : '' }}
                                        value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="frm-grp col-span-3">
                    <div class="grid grid-cols-12">
                        @php
                            $mileages = ['50000', '75000', '100000', '150000', '200000', '300000'];
                        @endphp
                        <div class="col-span-5">
                            <select name="min_mileage"
                                class="w-full rounded text-xs filter_s {{ request()->filled('min_mileage') ? 'bg-blue-200' : '' }}">
                                <option value="">MIN MILAGE</option>
                                @foreach ($mileages as $mileage)
                                    <option {{ request()->min_mileage == $mileage ? 'selected' : '' }}
                                        value="{{ $mileage }}">{{ $mileage }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <h1 class="text-center">~</h1>
                        </div>
                        <div class="col-span-5">
                            <select name="max_mileage"
                                class="w-full rounded text-xs filter_s {{ request()->filled('max_mileage') ? 'bg-blue-200' : '' }}">
                                <option value="">MAX MILAGE</option>
                                @foreach ($mileages as $mileage)
                                    <option {{ request()->max_mileage == $mileage ? 'selected' : '' }}
                                        value="{{ $mileage }}">{{ $mileage }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="frm-grp col-span-3">
                    <div class="grid grid-cols-12">
                        @php
                            $enginecss = ['700', '1000', '1500', '1800', '2000', '2500', '3000', '4000'];
                        @endphp
                        <div class="col-span-5">
                            <select name="enginecc_from"
                                class="w-full rounded text-xs filter_s {{ request()->filled('enginecc_from') ? 'bg-blue-200' : '' }}">
                                <option value="">MIN ENGINE</option>
                                @foreach ($enginecss as $cc)
                                    <option {{ request()->enginecc_from == $cc ? 'selected' : '' }}
                                        value="{{ $cc }}">{{ $cc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <h1 class="text-center">~</h1>
                        </div>
                        <div class="col-span-5">
                            <select name="enginecc_to"
                                class="w-full rounded text-xs filter_s {{ request()->filled('enginecc_to') ? 'bg-blue-200' : '' }}">
                                <option value="">MAX ENGINE</option>
                                @foreach ($enginecss as $cc)
                                    <option {{ request()->enginecc_to == $cc ? 'selected' : '' }}
                                        value="{{ $cc }}">{{ $cc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="frm-grp col-span-3">
                    <button type="button" id="show_filters_btn"
                        class="w-full bg-blue-400 text-white py-2 rounded text-xs">SHOW MORE OPTIONS <i
                            class="las la-angle-down"></i></button>
                    <button type="button" id="hide_filters_btn"
                        class="hidden w-full bg-blue-400 text-white py-2 rounded text-xs">HIDE MORE OPTIONS <i
                            class="las la-angle-up"></i></button>
                </div>
                {{-- hidden filter start --}}
                <div id="hidden_filters" class="hidden col-span-12">
                    <div class="grid grid-cols-12  gap-x-4 gap-y-2">
                        <div class="frm-grp col-span-3">
                            <select name="drive_type"
                                class="w-full rounded text-xs filter_s {{ request()->filled('drive_type') ? 'bg-blue-200' : '' }}">
                                <option value="">DRIVE TYPE</option>
                                <option {{ request()->drive_type == '2WD' ? 'selected' : '' }} value="2WD">2WD</option>
                                <option {{ request()->drive_type == '4WD' ? 'selected' : '' }} value="4WD">4WD</option>
                            </select>
                        </div>
                        <div class="frm-grp col-span-3">
                            <select name="color"
                                class="w-full rounded text-xs filter_s {{ request()->filled('color') ? 'bg-blue-200' : '' }}">
                                <option value="">COLOR</option>
                                @foreach (session('colors') as $color)
                                    <option {{ request()->color == $color->id ? 'selected' : '' }}
                                        value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="frm-grp col-span-3">
                            <select name="stock_country"
                                class="w-full rounded text-xs filter_s {{ request()->filled('stock_country') ? 'bg-blue-200' : '' }}">
                                <option value="">STOCK COUNTRY</option>
                                @foreach (session('countries') as $country)
                                    <option {{ request()->stock_country == $country->id ? 'selected' : '' }}
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="frm-grp col-span-3">
                            <select name="stock_location" class="w-full rounded text-xs" >
                                <option value="">STOCK LOCATION</option>
                                <option value="" >HOKKAIDO</option>
                                <option value="" >YOKOHAMA</option>
                                <option value="" >TOYAMA</option>
                            </select>
                        </div> --}}
                        <div class="frm-grp col-span-3">
                            <div class="grid grid-cols-12">
                                <div class="col-span-5">
                                    <input type="number" value="{{ request()->min_seats }}" name="min_seats"
                                        placeholder="MIN SEATS"
                                        class="w-full rounded text-xs filter_i {{ request()->filled('min_seats') ? 'bg-blue-200' : '' }}">
                                </div>
                                <div class="col-span-2">
                                    <h1 class="text-center">~</h1>
                                </div>
                                <div class="col-span-5">
                                    <input type="number" value="{{ request()->max_seats }}" name="max_seats"
                                        placeholder="MAX SEATS"
                                        class="w-full rounded text-xs filter_i {{ request()->filled('max_seats') ? 'bg-blue-200' : '' }}">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="frm-grp col-span-3">
                            <div class="grid grid-cols-12">
                                <div class="col-span-5">
                                    <select name="min_load" class="w-full rounded text-xs" >
                                        <option value="">MIN LOAD</option>
                                        <option value="" >1 TON</option>
                                        <option value="" >2 TON</option>
                                        <option value="" >3 TON</option>
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <h1 class="text-center">~</h1>
                                </div>
                                <div class="col-span-5">
                                    <select name="max_load" class="w-full rounded text-xs" >
                                        <option value="">MAX LOAD</option>
                                        <option value="" >1 TON</option>
                                        <option value="" >2 TON</option>
                                        <option value="" >3 TON</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="frm-grp col-span-3">
                            <select name="sub_body_type" class="w-full rounded text-xs" >
                                <option value="">SUB BODY TYPE</option>
                                <option value="" >BOAT</option>
                                <option value="" >CARGO</option>
                                <option value="" >CARRIER</option>
                            </select>
                        </div> --}}
                        <div class="frm-grp col-span-3">
                            {{-- EMPTY COL --}}
                        </div>
                        <div class="col-span-12">
                            <div class="grid grid-cols-6 gap-x-4 gap-y-2">
                                @foreach ($accessories as $accessory)
                                    <div class="frm-grp">
                                        <label class="text-sm" for="assc-{{ $accessory->id }}">
                                            <input class="filter_c"
                                                {{ in_array($accessory->id, request()->asscs ?? []) ? 'checked' : '' }}
                                                type="checkbox" name="asscs[]" value="{{ $accessory->id }}"
                                                id="assc-{{ $accessory->id }}"> {{ $accessory->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{-- hidden filter end --}}
                <div class="col-span-12">
                    <div class="grid grid-cols-6 gap-x-4 gap-y-2 text-red-600 font-bold">
                        @foreach ($deals as $deal)
                            <div class="frm-grp">
                                <label class="text-sm" for="deal-{{ $deal->id }}">
                                    <input class="filter_c"
                                        {{ in_array($deal->id, request()->deals ?? []) ? 'checked' : '' }}
                                        type="checkbox" name="deals[]" id="deal-{{ $deal->id }}"
                                        value="{{ $deal->id }}"> {{ $deal->title }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="frm-grp col-span-4 mt-4">
                    <h1 class="font-bold text-xl"><span id="stock_quantity">{{ $products->total() }}</span> <span
                            class="text-sm font-normal">items match the criteria</span></h1>
                </div>
                <div class="frm-grp col-span-8 mt-4 offset-4">
                    <button class="dark-blue-bg text-white py-2 px-8 rounded text-lg"><i class="las la-search"></i>
                        SEARCH</button> or <a href="{{ route('landing.stocklist') }}"
                        class="bg-blue-400 text-white py-2 px-8 rounded text-sm">Reset</a>
                </div>
            </form>
            {{-- search bar end --}}

            {{-- countries bar start --}}
            <div class="my-2 grid grid-cols-12 gap-1">
                <div class="col-span-12">
                    <p class="text-xs">View vehicles shipping from:</p>
                </div>
                <div class="col-span-7 flex gap-x-2">
                    <a href="{{ route('landing.stocklist') }}"
                        class="bg-gray-300 flex items-center text-xs border border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5">ALL</a>
                    <a href="{{ route('landing.stocklist', ['stock_country' => '213']) }}"
                        class="bg-gray-300 flex gap-x-1 items-center text-xs border border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5"><img
                            src="{{ asset('images/flags/thailand.png') }}" width="15px"> <span>THAILAND</span></a>
                    <a href="{{ route('landing.stocklist', ['stock_country' => '225']) }}"
                        class="bg-gray-300 flex gap-x-1 items-center text-xs border border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5"><img
                            src="{{ asset('images/flags/united-arab-emirates.png') }}" width="15px"> <span>UAE</span></a>
                    <a href="{{ route('landing.stocklist', ['stock_country' => '109']) }}"
                        class="bg-gray-300 flex gap-x-1 items-center text-xs border border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1"><img
                            src="{{ asset('images/flags/japan.png') }}" width="15px"> <span>JAPAN</span></a>
                    <a href="{{ route('landing.stocklist', ['stock_country' => '192']) }}"
                        class="bg-gray-300 flex gap-x-1 items-center text-xs border border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5"><img
                            src="{{ asset('images/flags/singapore.png') }}" width="15px"> <span>SINGAPOR</span></a>
                    <a href="{{ route('landing.stocklist', ['stock_country' => '226']) }}"
                        class="bg-gray-300 flex gap-x-1 items-center text-xs border border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5"><img
                            src="{{ asset('images/flags/united-kingdom.png') }}" width="15px"> <span>UK</span></a>
                    <a href="{{ route('landing.stocklist', ['stock_country' => '115']) }}"
                        class="bg-gray-300 flex gap-x-1 items-center text-xs border border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5"><img
                            src="{{ asset('images/flags/south-korea.png') }}" width="15px"> <span>KOREA</span></a>
                    <a href="{{ route('landing.stocklist', ['stock_country' => '244']) }}"
                        class="bg-gray-300 flex gap-x-1 items-center text-xs border border-blue-bg hover:bg-blue-800 hover:text-white rounded-sm text-xs px-1 py-1.5"><img
                            src="{{ asset('images/flags/united-states.png') }}" width="15px"> <span>USA</span></a>
                </div>
                <div class="col-span-5">
                    <form class="grid grid-cols-12 grid-flow-col auto-cols-auto justify-items-end" method="GET"
                        action="{{ route('landing.stocklist') }}">
                        <div class="col-span-4">
                            <select class="bg-gray-300 rounded text-xs py-1.5 w-full" name="port_country" id="port_country"
                                required>
                                <option value="">Country</option>
                                @forelse (session('countries') as $country)
                                    <option {{ request()->port_country == $country->id ? 'selected' : '' }}
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                @empty
                                    <option value="">No Country Found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-span-4">
                            <select class="bg-gray-300 rounded text-xs py-1.5 w-full" name="country_ports"
                                id="country_ports" required>
                                <option value="">Port</option>
                            </select>
                        </div>
                        <div class="col-span-4">
                            <button class="py-1.5 dark-blue-bg px-1.5 text-white rounded text-xs w-full">Calculate</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- countries bar end --}}

            {{-- stock list items start --}}
            <div class="stock_list_items space-y-4">
                <h1 class="text-xl font-bold dark-blue-text">STOCKLIST ({{ $products->total() }})</h1>
                <hr>

                @forelse ($products as $product)
                    <div class="grid grid-cols-12 gap-x-2 my-4">
                        {{-- vehicle cover --}}
                        <div class="col-span-2 relative">
                            {{-- <img src="{{ Storage::url($product->main_image_name) }}"> --}}
                            {{-- <a
                                href="{{ strtolower(route('landing.detail', [Str::slug($product->vcompany->name, '_'),$product->drive_type ?: 'Both',Str::slug($product->vtype->name, '_'),$product->engine_cc,$product->ref_no])) }}"> --}}
                                <?php
                                        $company=$product->vcompany->name?str_replace(' ', '', $product->vcompany->name):'';
                                        $type=$product->vtype->name?str_replace(' ', '',$product->vtype->name):'';
                                        $drivetype=$product->drive_type?str_replace(' ', '', $product->drive_type):'';
                                        $engine_cc=$product->engine_cc;

                                        $ref_no=$product->ref_no;


                                        $url=$type.'-'.$drivetype.'-'.$engine_cc.'-'.$ref_no;
                                        ?>
                                <a href="{{ route('seodetail',['company'=> $company,'url'=> $url]) }}">
                                <img src="{{ asset($product->main_image_name) }}"
                                    class="relative {{ $product->sold != 0 ? 'opacity-50' : '' }}">
                                @if ($product->sold == 1)
                                    <img class="absolute inset-0 w-full opacity-50"
                                        src="{{ asset('images/sold2.png') }}" alt="sold">
                                @endif
                                @if ($product->sold == 3)
                                    <img class="absolute inset-0 w-full opacity-50"
                                        src="{{ asset('images/hold.png') }}" alt="sold">
                                @endif
                            </a>
                            <h1 class="py-2 text-center gray-box font-bold">Ref No. {{ $product->ref_no ?? '' }}</h1>
                            {{-- @if ($product->sold == 1)
                            <h1 class="py-2 text-center gray-box font-bold text-green-500">SOLD</h1>
                            @endif --}}
                        </div>
                        {{-- vehicle details --}}
                        <div class="col-span-8">
                            <div class="grid grid-cols-12 gap-1">
                                <div class="col-span-12">
                                    <a href="{{ strtolower(route('landing.detail', [Str::slug($product->vcompany->name, '_'),$product->drive_type ?: 'Both',Str::slug($product->vtype->name, '_'),$product->engine_cc,$product->ref_no])) }}"
                                        class="text-xl dark-blue-text font-bold">{{ $product->manufacture_date ?? '' }}
                                        {{ $product->vcompany->name ?? '' }} {{ $product->vtype->name ?? '' }}
                                        {{ $product->drive_type ?? '' }}</a>
                                </div>
                                <div class="col-span-12">
                                    <div class="grid grid-cols-5 divide-solid divide-x-2">
                                        <div class="text-center text-sm space-y-2">
                                            <p>Mileage</p>
                                            <p class="dark-blue-text text-lg font-bold">
                                                {{ $product->mileage ?? 'N/A' }}</p>
                                        </div>
                                        <div class="text-center text-sm space-y-2">
                                            <p>Year</p>
                                            <p class="dark-blue-text text-lg font-bold">
                                                {{ $product->manufacture_date ?? 'N/A' }}</p>
                                        </div>
                                        <div class="text-center text-sm space-y-2">
                                            <p>Engine</p>
                                            <p class="dark-blue-text text-lg font-bold">{{ $product->engine_cc }}CC</p>
                                        </div>
                                        <div class="text-center text-sm space-y-2">
                                            <p>Trans.</p>
                                            <p class="dark-blue-text text-lg font-bold">{{ $product->transmission }}
                                            </p>
                                        </div>
                                        <div class="text-center text-sm space-y-2">
                                            <p>Location</p>
                                            <p class="dark-blue-text text-lg font-bold">
                                                {{ $product->vcountry->name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 mt-2">
                                    <table class="w-full border-collapse">
                                        <tbody>
                                            <tr class="text-xs text-left">
                                                <th class="border">Model Code</th>
                                                <td class="border">DAA-NKE165G</td>
                                                <th class="border">Steering</th>
                                                <td class="border">{{ $product->steering }}</td>
                                                <th class="border">Fuel</th>
                                                <td class="border">{{ $product->fuel_type }}</td>
                                                <th class="border">Seats</th>
                                                <td class="border">{{ $product->seats }}</td>
                                            </tr>
                                            <tr class="text-xs text-left">
                                                <th class="border">Engine code</th>
                                                <td class="border">1KZ</td>
                                                <th class="border">Color</th>
                                                <td class="border">{{ $product->vcolor->name ?? 'N/A' }}</td>
                                                <th class="border">Drive</th>
                                                <td class="border">{{ $product->drive_type }}</td>
                                                <th class="border">Doors</th>
                                                <td class="border">{{ $product->no_of_doors }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $tempFeatures = explode(',', $product->accessories);
                                    $features = array_slice($tempFeatures, 0, 6);
                                @endphp
                                <div class="col-span-12 mt-2">
                                    <div class="flex divide-solid divide-x-2 text-xs blue-text overflow-hidden">
                                        @foreach ($accessories as $accessory)
                                            @if (in_array($accessory->id, $features))
                                                <div class="px-2 text-center">{{ $accessory->name }}</div>
                                            @endif
                                        @endforeach
                                        {{-- <div class="px-2 text-center">Power Steering</div>
                                        <div class="px-2 text-center">Airbag</div>
                                        <div class="px-2 text-center">Keyless Entry</div>
                                        <div class="px-2 text-center">Back Camera</div>
                                        <div class="px-2 text-center">CD Player</div> --}}
                                        @if (count($tempFeatures) > 6)
                                            <div class="px-2 text-center">
                                                <a href="{{ strtolower(route('landing.detail', [$product->vcompany->name,$product->drive_type ?: 'Both',Str::slug($product->vtype->name, '_'),$product->engine_cc,$product->ref_no])) }}"
                                                    class="font-bold">and more</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- price and inquiry --}}
                        {{-- for available products --}}
                        @if ($product->sold == 0)
                            <div class="col-span-2 space-y-2">
                                <div class="grid grid-cols-2 items-center">
                                    <div class="text-gray-400 text-sm">Price</div>
                                    <div class="text-red-600 text-2xl font-bold text-right">USD {{ $product->price }}
                                    </div>
                                </div>
                                <hr>
                                <div class="grid grid-cols-2 items-center">
                                    <div class="text-gray-400 text-sm">Total Price</div>
                                    @if ($port != null)
                                        <div class="text-red-600 text-lg text-right" id="cif_price">USD
                                            {{ $product->price + $port->amount + $port->certificate + $port->insurance + $port->inspection }}
                                        </div>
                                    @else
                                        <div class="text-red-600 text-lg text-right" id="cif_price">USD
                                            {{ $product->price }}</div>
                                    @endif
                                    <div class="col-span-2 text-gray-500 text-sm text-right" id="cif_port">CIF To
                                        {{ $port != null ? $port->name : 'N/A' }}</div>
                                </div>
                                <div class="grid grid-cols-1 items-center">
                                    <button class="dark-blue-bg text-white py-1 text-xl rounded inquiry_btn"
                                        data-id="{{ $product->id }}"><i class="las la-envelope"></i> INQUIRY</button>
                                </div>
                            </div>
                        @endif

                        {{-- for sold products --}}
                        @if ($product->sold == 1)
                            <div class="col-span-2 space-y-2 flex items-center">
                                <div class="grid grid-cols-1 space-y-2 w-full">
                                    <button class="bg-green-500 text-white py-1 text-xl rounded"><i
                                            class="las la-money-bill-wave"></i> Sold</button>
                                    <a href="{{ route('pre-order', $product->id) }}"
                                        class="text-white bg-blue-600 py-1 text-center text-xl rounded">Preorder</a>
                                </div>
                            </div>
                        @endif

                        {{-- for in-offer products --}}
                        @if ($product->sold == 2)
                            <div class="col-span-2 space-y-2 flex items-center">
                                <div class="grid grid-cols-1 w-full">
                                    <button class="bg-gray-500 text-white py-1 text-xl rounded"><i
                                            class="las la-money-check-alt"></i> In Offer</button>
                                </div>
                            </div>
                        @endif

                        {{-- for on-hold products --}}
                        @if ($product->sold == 3)
                            <div class="col-span-2 space-y-2 flex items-center">
                                <div class="grid grid-cols-1 w-full">
                                    <button class="bg-yellow-500 text-white py-1 text-xl rounded"><i
                                            class="las la-hand-holding-usd"></i> On Hold</button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr>
                @empty
                @endforelse
                {{ $products->appends(request()->query())->links() }}
            </div>
            {{-- stock list items end --}}
        </div>
    </div>
    {{-- contact information --}}
    @include('includes.contact-info')
@endsection


@section('modal')
    {{-- inquiry modal starts --}}
    @foreach ($products as $product)
        @if ($product->sold == 0)
            <div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
                id="inquiry_form_dialogue_{{ $product->id }}">
                <div class="relative grid grid-cols-12 border gap-y-2 bg-white w-6/12 mx-auto items-center">
                    <div class="col-span-10">
                        <h1 class="p-2 bg-red-600 text-white font-bold">INQUIRY (FREE QUOTE)</h1>
                    </div>
                    <div class="col-span-2 bg-red-600 text-white text-right">
                        <button class="p-2 mr-auto inquiry_close_btn" data-id="{{ $product->id }}"><i
                                class="las la-times"></i></button>
                    </div>
                    <div class="col-span-12 px-2">
                        <h1>{{ $product->vcompany->name ?? '' }} {{ $product->vtype->name }}
                            ({{ $product->ref_no }})</h1>
                    </div>
                    <div class="col-span-12 px-2">
                        <div class="grid grid-cols-3">
                            <div class="col-span-1">
                                <img src="{{ asset($product->main_image_name) }}">
                            </div>
                            <div class="col-span-2">
                                <table class="w-full">
                                    <tbody class="text-xs">
                                        <tr>
                                            <th>Year</th>
                                            <td>{{ $product->manufacture_date ?? '' }}</td>
                                            <th>Final Country</th>
                                            <td>{{ $stockCountry->name }}</td>
                                        </tr>

                                        <tr>
                                            <th>Engine</th>
                                            <td>2,950cc</td>
                                            <th>Port / City</th>
                                            <td>KARACHI</td>
                                        </tr>

                                        <tr>
                                            <th>Mileage</th>
                                            <td>{{ $product->mileage ?? '' }}</td>
                                            <th>Insurance</th>
                                            <td>YES</td>
                                        </tr>

                                        <tr>
                                            <th>Steering</th>
                                            <td>{{ $product->steering ?? '' }}</td>
                                            <th>Total Price</th>
                                            @if ($port != null)
                                                <td>USD
                                                    {{ $product->price + $port->amount + $port->certificate + $port->insurance + $port->inspection }}
                                                </td>
                                            @else
                                                <td>USD {{ $product->price }}</td>
                                            @endif
                                        </tr>

                                        <tr>
                                            <th>Trans</th>
                                            <td>{{ $product->transmission ?? '' }}</td>
                                            <th>Warranty</th>
                                            <td>YES</td>
                                        </tr>

                                        <tr>
                                            <th>Location</th>
                                            <td>{{ $product->vcountry->name ?? '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 px-2">
                        <form class="grid grid-cols-3 gap-y-3 gap-x-2 items-center" method="POST"
                            action="{{ route('landing.quote-request') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="frm-grp col-span-1">
                                <h1 class="text-right">Your Name<span class="text-red-600">*</span></h1>
                            </div>
                            <div class="frm-grp col-span-2">
                                <input type="text" name="name" class="w-full rounded text-xs" placeholder="Full Name">
                            </div>
                            <div class="frm-grp col-span-1">
                                <h1 class="text-right">Email<span class="text-red-600">*</span></h1>
                            </div>
                            <div class="frm-grp col-span-2">
                                <input type="text" name="email" class="w-full rounded text-xs" placeholder="Email Address">
                            </div>
                            <div class="frm-grp col-span-1">
                                <h1 class="text-right">City<span class="text-red-600">*</span></h1>
                            </div>
                            <div class="frm-grp col-span-2">
                                <input type="text" name="city" class="w-full rounded text-xs" placeholder="City">
                            </div>
                            <div class="frm-grp col-span-1">
                                <h1 class="text-right">Address<span class="text-red-600">*</span></h1>
                            </div>
                            <div class="frm-grp col-span-2">
                                <input type="text" name="address" class="w-full rounded text-xs"
                                    placeholder="Street, Town, Province">
                            </div>
                            <div class="frm-grp col-span-1">
                                <h1 class="text-right">Telephone<span class="text-red-600">*</span></h1>
                            </div>
                            <div class="frm-grp col-span-2">
                                <input type="text" name="tel" class="w-full rounded text-xs"
                                    placeholder="Cell Phone or Telephone No.">
                            </div>
                            <div class="frm-grp col-span-1">
                                <h1 class="text-right">Country<span class="text-red-600">*</span></h1>
                            </div>
                            <div class="frm-grp col-span-2">
                                <select name="country" class="w-full rounded text-xs">
                                    @foreach (session('countries') as $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="frm-grp col-span-1">
                                <h1 class="text-right">Discount Coupon</h1>
                            </div>
                            <div class="frm-grp col-span-2">
                                <div class="grid grid-cols-12 items-center">
                                    <div class="col-span-10">
                                        <input type="text" class="w-full rounded-l border-r-0 text-xs"
                                            placeholder="Optional">
                                    </div>
                                    <div class="col-span-2">
                                        <button type="button"
                                            class="w-full py-2 rounded-r border border-gray-500 border-l-0 text-xs bg-gray-300">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="frm-grp col-span-1">
                                <h1 class="text-right">Captcha<span class="text-red-600">*</span></h1>
                            </div>
                            <div class="frm-grp col-span-2">
                                <div class="g-recaptcha" data-sitekey="6LcJ7sUdAAAAAIbPuP1BVVVLU5u98uvVfTZamyKj"></div>
                            </div>
                            <div class="frm-grp col-span-1">
                            </div>
                            <div class="frm-grp col-span-2">
                                <button type="submit" class="w-full rounded text-xl bg-red-600 text-white py-4"><i
                                        class="las la-envelope"></i> GET A PRICE QUOTE</button>
                            </div>
                            <div class="frm-grp col-span-1">
                            </div>
                            <div class="frm-grp col-span-2 tex-center">
                                <label for="news" class="text-xs">
                                    <input type="checkbox" name="news" id="news"> Receive news, coupons and special deals
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    {{-- Inquiry form ends --}}
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            alert('d');
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
                $("#inquiry_form_dialogue_" + id).removeClass("hidden")
                $("#inquiry_form_dialogue_" + id).addClass("z-10");

            })

            $(".inquiry_close_btn").click(function() {
                var id = $(this).data('id')
                $("#inquiry_form_dialogue_" + id).addClass("hidden");
                $("#inquiry_form_dialogue_" + id).removeClass("z-10")
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

            calculatorPorts();


            // location based estimate
            // var country = @json($stockCountry);
            // console.log(country);
            // getPorts(country.id);

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

        function calculatorPorts() {
            axios.get('/api/ports/' + $("#port_country").val()).then(function(response) {
                let ports = response.data;
                $("#country_ports").empty();
                for (let i = 0; i < ports.length; i++) {
                    $("#country_ports").append(
                        `<option value=${ports[i].id}>${ports[i].name}</option>`
                    )
                }
            })
        }

        // function getPorts(id){
        //     axios.get('/api/ports/'+id)
        //         .then(function(response){
        //             var ports = response.data;
        //             var port = ports[0];

        //             $("#cif_port").html("CIF To " + port.name);

        //             priceCalculator(port);
        //         });
        // }

        // function priceCalculator(port){

        //     var totalPrice = parseInt(port.amount) + parseInt(port.insurance) + parseInt(port.inspection) + parseInt(port.certificate);
        //     $("#cif_price").html("$"+totalPrice);
        // }
    </script>
@endpush
