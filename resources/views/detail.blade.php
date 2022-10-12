@extends('layouts.main')
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
    <div class="my-4 px-8" id="div_print">
        <div class="grid grid-cols-3 gap-3">
            <div id="vehicle-details" class="p-3 gray-box shadow-lg col-span-1">
                {{-- vehicle details here --}}
                <h1 class="dark-blue-text text-lg font-bold text-center">{{ $product->manufacture_date ?? '' }} {{ $product->vcompany->name ?? '' }} {{ $product->vtype->name ?? '' }} {{ $product->drive_type ?? '' }} {{ $product->transmission ?? '' }}</h1>
                {{-- <h1 class="dark-blue-text text-lg font-bold text-center">2018 TOYOTA COMMUTER 2WD AT</h1> --}}
                <div class="flex items-center justify-between my-1">
                    <p class="text-gray-400 font-bold">{{ $product->ref_no ?? '' }}</p>
                    <button class="px-6 gray-box rounded-md" style="box-shadow: 2px 2px 10px grey" onClick="printdiv('div_print');"><i class="las la-print"></i>Print</button>
                </div>
                {{-- if product available --}}
                @if($product->sold == 0)
                <div class="flex items-center justify-stretch">
                    <div class="dark-blue-bg text-white text-center p-1 border-r border-white flex-1">CURRENT PRICE</div>
                    <div class="dark-blue-bg text-white text-center font-bold p-1 border-l border-white flex-1">
                        <span class="text-red-400 font-normal text-sm mr-4 line-through">{{$product->discount ? 'USD ' . $product->discount : ''}}</span>
                        <span class="font-extrabold">USD {{ $product->price }}</span>
                        <input type="hidden" id="prod_price" value="{{ $product->price }}">
                    </div>
                </div>
                <div class="mt-4 py-1 text-center">
                    <a href="#shipping_dest_section" class="text-white bg-red-600 rounded-md px-2 py-2 font-bold" style="box-shadow: 2px 2px 10px lightcoral;">GET A PRICE QUOTE NOW</a>
                </div>
                @endif
                {{-- if product sold --}}
                @if($product->sold == 1)
                <div class="flex items-center justify-center">
                    <div class="bg-green-500 text-white text-center font-bold p-1 border-r border-white flex-1">SOLD</div>
                </div>
                <div class="mt-4 py-1 text-center">
                    <a href="{{ route('landing.stocklist', ['maker' => $product->company, 'model' => $product->vmodel]) }}" class="text-white bg-red-600 rounded-md px-2 py-2 font-bold" style="box-shadow: 2px 2px 10px lightcoral;">See Similar Vehicles</a>
                </div>
                <div class="mt-4 py-1 text-center">
                    <a href="{{ route('pre-order', $product->id) }}" class="text-white bg-blue-600 rounded-md px-2 py-2 font-bold" style="box-shadow: 2px 2px 10px lightblue;">Pre Order</a>
                </div>
                @endif
                {{-- if product on hold --}}
                @if($product->sold == 2)
                <div class="flex items-center justify-center">
                    <div class="bg-gray-500 text-white text-center font-bold p-1 border-r border-white flex-1">ON OFFER</div>
                </div>
                <div class="mt-4 py-1 text-center">
                    <a href="{{ route('landing.stocklist', ['maker' => $product->company, 'model' => $product->vmodel]) }}" class="text-white bg-red-600 rounded-md px-2 py-2 font-bold" style="box-shadow: 2px 2px 10px lightcoral;">See Similar Vehicles</a>
                </div>
                @endif
                {{-- if product on hold --}}
                @if($product->sold == 3)
                @php
                    $currentTime = \Carbon\Carbon::now();
                    $holdTime = $product->onhold_duration;
                    // $remainingTime = $holdTime->diffInSeconds($currentTime);
                    $remainingHours = $holdTime->diffInHours($currentTime);
                    $remainingMinuts = $holdTime->diff($currentTime)->format('%I');
                    $remainingSeconds = $holdTime->diff($currentTime)->format('%S');
                    // $remainingTime = $holdTime->diffInHours($currentTime) . ':' . $holdTime->diff($currentTime)->format('%I:%S');
                @endphp
                <div class="flex items-center justify-center">
                    <div class="bg-yellow-500 text-white text-center font-bold p-1 border-r border-white flex-1">ON HOLD</div>
                </div>
                <div class="flex flex-col items-center justify-center my-2">
                    <h4 class="text-center p-1">It could become available in:</h4>
                    {{-- <h3 class="text-center text-2xl font-bold" id="hold_timer">45h 32m 39s</h3> --}}
                    {{-- <h3 class="text-center text-2xl font-bold" id="hold_timer">{{ gmdate('H:i:s',$remainingTime) }}</h3> --}}
                    <h3 class="text-center text-2xl font-bold" id="hold_timer">
                        <span id="rhours" class="dark-blue-text">{{ $remainingHours }}</span>
                        <span class="text-xs">h</span>
                        <span id="rminutes" class="dark-blue-text">{{ $remainingMinuts }}</span>
                        <span class="text-xs">m</span>
                        <span id="rseconds" class="dark-blue-text">{{ $remainingSeconds }}</span>
                        <span class="text-xs">s</span>
                    </h3>
                </div>
                <div class="mt-4 py-1 text-center">
                    <a href="{{ route('landing.stocklist', ['maker' => $product->company, 'model' => $product->vmodel]) }}" class="text-white bg-red-600 rounded-md px-2 py-2 font-bold" style="box-shadow: 2px 2px 10px lightcoral;">See Similar Vehicles</a>
                </div>
                <div class="mt-4 py-1 text-center">
                    <a href="{{ route('user.notification.store', $product->id) }}" class="text-white bg-green-600 rounded-md px-2 py-2 font-bold" style="box-shadow: 2px 2px 10px lightblue;">Notify Me When Available</a>
                </div>
                @endif
                <div class="mt-4">
                    <div><span class="dark-blue-bg text-white px-1">Specs</span></div>
                    <div class="mt-4">
                        <table class="w-full border-collapse">
                            <tbody>
                                <tr class="divide divide-x divide-gray-300">
                                    <th>
                                        <h1>Mileage</h1>
                                        <h1 class="font-bold">{{ $product->mileage }}</h1>
                                    </th>
                                    <th>
                                        <h1>Year</h1>
                                        <h1 class="font-bold">{{ $product->manufacture_date }}</h1>
                                    </th>
                                    <th>
                                        <h1>Engine</h1>
                                        <h1 class="font-bold">{{ $product->engine_cc }}</h1>
                                    </th>
                                    <th>
                                        <h1>Transmission</h1>
                                        <h1 class="font-bold">{{ $product->transmission }}</h1>
                                    </th>
                                    <th>
                                        <h1>Fuel</h1>
                                        <h1 class="font-bold">{{ $product->fuel_type }}</h1>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <table class="w-full border-collapse border border-blue-300 break-all">
                            <tbody>
                                <tr>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">REF #</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->ref_no ?? '' }}</td>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">LOCATION</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->vcountry->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">CHAIS #</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->chassis_no ?? '' }}</td>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">CLASS</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->grade ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">ENGINE SIZE</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->engine_cc ?? '' }} CC</td>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">DRIVE</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->drive_type ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">STEERTING</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->steering ?? '' }}</td>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">TRANSMISSION</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->transmission ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">REG# YEAR</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->manufacture_date ?? '' }}</td>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">COLOR</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->color->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">FUEL</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->fuel_type ?? '' }}</td>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">MANUFACTURE YEAR</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->manufacture_date ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">SEAT</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->seats ?? '' }}</td>
                                    <td class="border border-gray-300 bg-gray-200 overflow-hidden break-words text-xs">DOORS</td>
                                    <td class="border border-gray-300 px-2 overflow-hidden break-words text-xs">{{ $product->no_of_doors ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="grid grid-cols-4 gap-2 mt-4">
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">REF #</h1>
                        </div>
                        <div class="text-xs">{{ $product->ref_no ?? '' }}</div>
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">LOCATION</h1>
                        </div>
                        <div class="gray-box text-xs break-words">{{ $product->vcountry->name ?? '' }}</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">CHAIS #</h1>
                        </div>
                        <div class="text-xs break-words">{{ $product->chassis_no ?? '' }}</div>
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">CLASS</h1>
                        </div>
                        <div class="gray-box text-xs">{{ $product->grade ?? '' }}</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">ENGINE SIZE</h1>
                        </div>
                        <div class="text-xs">{{ $product->engine_cc ?? '' }} CC</div>
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">ENGINE CODE</h1>
                        </div>
                        <div class="gray-box text-xs">{{ $product->engine_code ?? '' }}</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">DRIVE</h1>
                        </div>
                        <div class="text-xs">{{ $product->drive_type ?? '' }}</div>
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">STEERTING</h1>
                        </div>
                        <div class="gray-box text-xs">{{ $product->steering ?? '' }}</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">TRANSMISSION</h1>
                        </div>
                        <div class="text-xs">{{ $product->transmission ?? '' }}</div>
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">COLOR</h1>
                        </div>
                        <div class="gray-box text-xs">{{ $product->vcolor->name ?? '' }}</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">REG# YEAR/MONTH</h1>
                        </div>
                        <div class="text-xs">{{ $product->manufacture_date ?? '' }}</div>
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">FUEL</h1>
                        </div>
                        <div class="gray-box text-xs">{{ $product->fuel_type ?? '' }}</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">MANUFACTURE YEAR/MONTH</h1>
                        </div>
                        <div class="text-xs">{{ $product->manufacture_date ?? '' }}</div>
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">SEAT</h1>
                        </div>
                        <div class="gray-box text-xs">{{ $product->seats ?? '' }}</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        <div class="text-xs">
                            <h1 class="bg-whte text-blue-600">DOOR</h1>
                        </div>
                        <div class="text-xs">{{ $product->no_of_doors ?? '' }}</div>
                    </div> --}}
                </div>
            </div>
            {{-- vehicle images here --}}
            <div id="img-gallery" class="col-span-2">
                {{-- upper row --}}
                <div class="flex gap-2">
                    {{-- mini images vertical --}}
                    <div class="flex flex-col itmes-center justify-between gap-1 w-32 overflow-y-scroll" style="height: 500px">
                        @forelse ($product->photos->where('is_private', 0)->sortBy('sorting_order') as $photo)
                        <div class="w-full">
                            <a href="{{ asset($photo->name) }}" data-lightbox="vehicle-images">
                                {{-- <img src="{{ Storage::url($photo->name) }}"> --}}
                                <img src="{{ asset($photo->name) }}">
                            </a>
                        </div>
                        @empty

                        @endforelse
                    </div>
                    {{-- cover image --}}
                    <div class="w-full flex-1 relative">
                        <a href="{{ asset($product->main_image_name) }}" data-lightbox="vehicle-images">
                            {{-- <img class="h-full w-full object-cover" src="{{ Storage::url($product->main_image_name) }}"> --}}
                            <img class="relative top-0 left-0 h-full w-full object-cover {{ $product->sold != 0 ? 'opacity-50' : '' }}" src="{{ asset($product->main_image_name) }}">
                            @if ($product->sold == 1)
                                <img class="absolute inset-0 w-full h-full opacity-50" src="{{ asset('images/sold2.png') }}" alt="sold">
                            @endif
                            @if ($product->sold == 3)
                                <img class="absolute inset-0 w-full h-full opacity-50" src="{{ asset('images/hold.png') }}" alt="hold">
                            @endif
                        </a>
                    </div>
                </div>

                {{-- lower row --}}
                {{-- horizontal mini images --}}
                <div class="flex itmes-center justify-between gap-1 mt-2 overflow-x-auto">
                    @forelse ($product->photos->where('is_private', 0)->sortBy('sorting_order') as $photo)
                    <div class="w-32">
                        <a href="{{ asset($photo->name) }}" data-lightbox="vehicle-images">
                            {{-- <img src="{{ Storage::url($photo->name) }}"> --}}
                            <img src="{{ asset($photo->name) }}">
                        </a>
                    </div>
                    @empty

                    @endforelse
                </div>
                <div class="flex justify-end mt-1">
                    <a href="{{ route('products.zip', $product->id) }}" class="text-sm dark-blue-text underline">Download pictures in a single zip file</a>
                </div>
                <h1 class="text-xs my-2">Share with others</h1>
                <div class="flex items-center gap-2 mt-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}&src=sdkpreparse" target="_blank" class="bg-blue-600 text-white px-2 py-1 text-xl bg-gray-500 fb-share-button"><i style="font-size: 30px;" class="lab la-facebook"></i></a>
                    <a href="whatsapp://send?text={{ request()->url() }}" target="_blank" class="bg-green-600 text-white px-2 py-1 text-xl bg-gray-500"><i style="font-size: 30px;" class="lab la-whatsapp"></i></a>
                    <a href="viber://forward?text={{ request()->url() }}" target="_blank" class="bg-purple-600 text-white px-2 py-1 text-xl bg-gray-500"><i style="font-size: 30px;" class="lab la-viber"></i></a>
                    <a href="https://social-plugins.line.me/lineit/share?url={{ request()->url() }}" target="_blank" class="bg-green-600 text-white px-2 py-1 text-xl bg-gray-500"><i style="font-size: 30px;" class="lab la-line"></i></a>
                    <a href="mailto:?subject={{ $product->vcompany->name .' ' . $product->vtype->name }} - SG Asia Cars&body={{ request()->url() }}" target="_blank" class="bg-red-600 text-white px-2 py-1 text-xl bg-gray-500"><i style="font-size: 30px;" class="lab la-google"></i></a>
                </div>
            </div>
        </div>

        {{-- standard features --}}
        <div class="grid grid-cols-3 gap-3 mt-4">
            <span class="span-cols-1 dark-blue-bg py-1 text-white text-center text-lg font-bold">STANDARD FEATURES</span>
        </div>

        @php
            $features = explode(",", $product->accessories);
        @endphp

        <div class="grid grid-cols-12 gap-3 p-2 gray-box shadow-md mt-4">
            <div class="col-span-4">
                <div class="grid grid-cols-4 gap-2 dark-blue-text text-xs text-center">
                    @forelse ($accessories as $accessory)
                        <div class="p-1 {{ in_array($accessory->id, $features) ? 'bg-blue-200' : '' }} shadow flex items-center justify-center break-words" style="box-shadow: 1px 1px 5px grey">{{ $accessory->name }}</div>
                    @empty
                        <div class="p-1 shadow flex items-center justify-center break-words" style="box-shadow: 1px 1px 5px grey">No Accessories Found</div>
                    @endforelse
                </div>
            </div>
            @if($product->sold == 0)
            <div class="col-span-8 dark-blue-bg" id="shipping_dest_section">
                <div class="bg-white py-1 dark-blue-text px-1 font-bold text-lg">
                    <p>STEP 1 > <i class="las la-globe"></i> SHIPPING DESTINATION</p>
                </div>

                <form method="GET" class="grid grid-cols-12 gap-1 mt-4">
                    <div class="col-span-3 p-1">
                        <h1 class="text-white text-sm">FINAL COUNTRY</h1>
                    </div>
                    <div class="col-span-6">
                        <select name="country" id="location" class="py-1 w-full border-0 rounded focus:outline-none focus:ring-0">
                            @foreach ($countries as $country)
                                <option {{ $country->name == $location ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <div class="grid grid-cols-12 gap-1 mt-4">
                    <div class="col-span-3 p-1">
                        <h1 class="text-white text-sm">PORT/CITY</h1>
                    </div>
                    <div class="col-span-4">
                        <h1 class="text-white text-sm" id="port-city">KARACHI</h1>
                        <p class="text-white text-xs">pick up at port (RORO)</p>
                    </div>
                    <div class="col-span-5">
                        <button class="px-6 bg-blue-400 text-white rounded-md shadow-lg" id="close_btn">Close <i class="las la-angle-up"></i></button>
                        <button class="px-4 bg-blue-400 text-white rounded-md shadow-lg hidden" id="show_btn">Show Prices <i class="las la-angle-down"></i></button>
                    </div>
                </div>

                <div class="mt-4" id="port_details">
                    <h1 class="text-sm text-white" id="from-city">from KARACHI port to</h1>
                    <div id="ports-table">
                    </div>
                </div>

                <div class="insuranc_etc mt-4 px-1">
                    <div>
                        <p class="text-white text-sm">Additional Options</p>
                    </div>
                    <div>
                        <label for="marine" class="text-white">
                            <input type="checkbox" name="marine" id="marine">
                            Marine Insurance <span><i class="las la-question-circle" title="Marine Insurance covers the total loss by shipwreck"></i></span>
                        </label>
                    </div>
                    <div>
                        <label for="sginsp" class="text-white">
                            <input type="checkbox" name="marine" id="sginsp">
                            Inscpection
                        </label>
                    </div>
                    <div>
                        <label for="sgwar" class="text-white">
                            <input type="checkbox" name="marine" id="sgwar">
                            SG Waranty
                        </label>
                    </div>
                    <div class="mt-4">
                        <h1 class="cursor-pointer text-white" id="discount_btn">Discount Coupon Code <i class="las la-angle-down"></i></h1>
                        <div id="discount_body">
                            <div class="flex items-center">
                                <div class="frm-grp">
                                    <input type="text" class="text-sm py-2 border-0 rounded-l" name="coupon_code" id="coupon_code">
                                </div>
                                <div class="frm-grp">
                                    <button class="py-2 px-4 border-0 text-sm bg-blue-300 text-white rounded-r">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-2">
                <div class="w-full p-2 flex justify-between text-white text-xl font-bold">
                    <div>
                        <h1>Total Price:</h1>
                    </div>
                    <div>
                        <h1>CNF <span class="text-red-600" id="totalEstimate">$12,000</span></h1>
                    </div>
                </div>

                <div class="bg-white py-1 dark-blue-text font-bold text-lg">
                    STEP 2 > <i class="las la-envelope"></i> GET A QUOTE
                </div>
                <form class="grid grid-cols-12 gap-y-2 gap-x-8 p-2" action="{{ route('landing.quote-request') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                    <p class="text-white col-span-12">Please fill the <span class="text-red-700">*</span>required fields.</p>
                    <div class="frm-grp col-span-6">
                        <label for="name" class="text-white">Your Name<span class="text-red-700">*</span></label>
                        <br>
                        <input type="text" name="name" placeholder="Full Name" class="py-2 rounded w-full" required>
                    </div>
                    <div class="frm-grp col-span-6">
                        <label for="country" class="text-white">Your Country<span class="text-red-700">*</span></label>
                        <br>
                        <select name="country" class="py-2 rounded w-full" required>
                            @foreach ($countries as $country)
                                <option {{ $country->name == $location ? 'selected' : '' }} value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="frm-grp col-span-6">
                        <label for="email" class="text-white">Email<span class="text-red-700">*</span></label>
                        <br>
                        <input type="email" name="email" placeholder="Email Address" class="py-2 rounded w-full" required>
                    </div>
                    <div class="frm-grp col-span-6">
                        <label for="address" class="text-white">Address<span class="text-red-700">*</span></label>
                        <br>
                        <input type="text" name="address" placeholder="Street, Town, Province" class="py-2 rounded w-full" required>
                    </div>
                    <div class="frm-grp col-span-6">
                        <label for="tel" class="text-white">Tel<span class="text-red-700">*</span></label>
                        <br>
                        <input type="text" name="tel" placeholder="Cell Phone or Telephone No." class="py-2 rounded w-full" required>
                    </div>
                    <div class="frm-grp col-span-6">
                        <label for="city" class="text-white">City<span class="text-red-700">*</span></label>
                        <br>
                        <input type="text" name="city" placeholder="City" class="py-2 rounded w-full" required>
                    </div>
                    <div class="frm-grp col-span-6">
                        <label for="city" class="text-white">Captcha<span class="text-red-700">*</span></label>
                        <br>
                        <div class="g-recaptcha" data-sitekey="6LcJ7sUdAAAAAIbPuP1BVVVLU5u98uvVfTZamyKj"></div>
                    </div>
                    <div class="frm-grp col-span-12 mt-4 text-center">
                        <button type="submit" class="bg-red-600 text-white py-2 px-6 rounded-sm"><i class="las la-envelope"></i> SEND QUOTE REQUEST</button>
                    </div>
                    <div class="frm-grp col-span-12 mt-4 text-center">
                        <a href="https://api.whatsapp.com/send/?phone=+66917869096&text={{ request()->url() }}" target="_blank" class="bg-green-600 text-white py-2 px-6 rounded-sm"><i class="lab la-whatsapp"></i> Whatapp</a>
                    </div>
                </form>
            </div>
            @endif
        </div>

        {{-- similar and related vehicle --}}
        <div class="grid grid-cols-3 gap-3 mt-4">
            <span class="span-cols-1 dark-blue-bg py-1 text-white text-center text-lg font-bold">SIMILAR AND RELATED VEHICLES</span>
        </div>
        <div class="grid grid-cols-8 gap-2 mt-6">
            @forelse ($similarProducts as $product)
            {{-- car card --}}
            <a href="{{ strtolower(route('landing.detail', [$product->vcompany->name,  $product->drive_type ?: 'Both', Str::slug($product->vtype->name, '_'), $product->engine_cc, $product->ref_no])) }}">
                <div class="card flex flex-col gap-2">
                    <img src="{{ asset($product->main_image_name) }}" alt="thumbnail">
                    <div class="py-2 gray-bg">
                        <h1 class="dark-blue-bg text-white font-bold text-center">{{ $product->vcompany->name . ' ' . $product->vtype->name . ' - ' . $product->ref_no }}</h1>
                        <div class="px-4 bg-white">
                            <h1 class="text-xs text-center py-1">{{ $product->manufacture_date . ' | ' . $product->transmission  }}</h1>
                            <h1 class="text-center px-2">PRICE</h1>
                        </div>
                        <h1 class="dark-blue-text font-bold text-center">USD {{ $product->price ?? '' }}</h1>
                    </div>
                </div>
            </a>
            @empty
                <div class="col-span-8 flex items-center justify-center">
                    <h1 class="text-sm text-center">No Similar Products Found</h1>
                </div>
            @endforelse
        </div>

    </div>
    {{-- contact information --}}
    @include('includes.contact-info')
@endsection


@push('js')
    <script src="{{ asset('lightbox/js/lightbox.min.js') }}"></script>

    <script>
        function printdiv(printpage)
        {
            window.print();
        }

        $(document).ready(function(){

            $("#close_btn").click(function(){
                $("#show_btn").removeClass('hidden');
                $("#close_btn").addClass('hidden');
                $("#port_details").addClass('hidden');
            });

            $("#show_btn").click(function(){
                $("#show_btn").addClass('hidden');
                $("#close_btn").removeClass('hidden');
                $("#port_details").removeClass('hidden');
            });

            $("#discount_btn").click(function(){
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

            htimer()


        });


        // calculator
        $('#location').change(function(){
            // alert($(this).val());
            getPorts();
        });

        // timer start

        function htimer(){
            var hours = $("#rhours").text();
            var minutes = $("#rminutes").text();
            var seconds = $("#rseconds").text();

            // var hours = 0
            // var minutes = 0
            // var seconds = 10

            var hold_timer = setInterval(() => {

                seconds--;
                if(seconds < 0){
                    seconds = 59;
                    minutes--
                }
                if(minutes < 0){
                    minutes = 59;
                    hours--
                }
                if(hours < 0){
                    hours = 0;
                    minutes = 0;
                    seconds = 0;
                    clearInterval(hold_timer);
                    return;
                }

                // console.log("hours: " + hours + " minutes:" + minutes + " seconds:" + seconds);

                if(hours < 10){
                    thours = "0" + hours;
                    $("#rhours").text(thours);
                }else{
                    $("#rhours").text(hours);
                }

                if(minutes < 10){
                    tminutes = "0" + minutes;
                    $("#rminutes").text(tminutes);
                }else{
                    $("#rminutes").text(minutes);
                }

                if(seconds < 10){
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
                        $("#from-city").html('From '+ports[0].name+' port to')
                        for(let i = 0; i < portsLength; i++){
                            $("#ports-table").append(
                                `<div class="bg-blue-200 grid grid-cols-12 gap-1 px-2 py-4">
                                    <div class="port col-span-4">
                                        <label for="port${ports[i].id}">
                                            <input type="radio" name="desport" onclick="priceCalculator()" id="port${ports[i].id}" value="${ports[i].amount}" data-insurance="${ports[i].insurance}" data-inspection="${ports[i].inspection}" data-warranty="${ports[i].warranty}" data-certificate="${ports[i].certificate}" checked>
                                            ${ports[i].name}
                                        </label>
                                    </div>
                                    <div class="col-span-4">
                                        <p class="text-center">pick up at port (RORO)</p>
                                    </div>
                                    <div class="col-span-4">
                                        <p class="text-red-700 text-right">USD ${ports[i].amount}</p>
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
