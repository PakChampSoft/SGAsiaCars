@extends('layouts.main')
@push('title')
    <title> {{$pagedata->seo_title}}</title>
@endpush
@push('meta')
<meta name="description" content="{{ $pagedata? $pagedata->meta_description: "" }}">
<meta name="keywords" content="{{ $pagedata? $pagedata->meta_keywords: "" }}">
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
    <div class="grid grid-cols-12 mt-4 gap-4">
        <div class="col-span-2">
            @include('includes.sidebar')
        </div>
        <div class="col-span-10">
            <h1 class="dark-blue-text font-bold text-xl">How To Buy</h1>
            <hr class="border border-blue-600">
            <div class="my-4">
                <fieldset class="border-2">
                    <legend class="mx-4 px-2 text-xl font-bold"><h2>STEP 1 - ORDER</h2></legend>
                    <div class="px-8 py-4 grid grid-cols-2 gap-8">
                        <div class="flex flex-col justify-center items-center gap-4">
                            <div>
                                <img src="{{ asset('images/buy/s1.png') }}" alt="s1" class="w-60 h-60">
                            </div>
                            <div>
                                <p class="text-center">CHOOSE THE VEHICLE YOU WANT TO PURCHASE.OUR CAR SEARCH ENGINE WILL HELP YOU SEARCH THROUGH OUR INVENTORY.</p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center gap-4">
                            <div>
                                <img src="{{ asset('images/buy/s2.png') }}" alt="s2" class="w-60 h-60">
                            </div>
                            <div>
                                <p class="text-center">YOU CAN ALSO CUSTOMIZE SEARCH DEPENDING ON YOUR REQUIREMENT AND PREFERENCES. DETAILED PHOTOS AND SPECIFICATIONS CAN BE SEEN FOR EACH INVENTORY.</p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="my-4">
                <fieldset class="border-2">
                    <legend class="mx-4 px-2 text-xl font-bold"><h2>STEP 2 - BUY NOW</h2></legend>
                    <div class="px-8 py-4 grid grid-cols-2 gap-8">
                        <div class="flex flex-col justify-center items-center gap-4">
                            <div>
                                <img src="{{ asset('images/buy/s3.png') }}" alt="s3" class="w-60 h-60">
                            </div>
                            <div>
                                <p class="text-center">SET YOUR PURCHASE CONDITION LIKE DESTINATION COUNTRY,DESTINATION PORT AND SO ON</p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center gap-4">
                            <div>
                                <img src="{{ asset('images/buy/s4.PNG') }}" alt="s4">
                            </div>
                            <div>
                                <p class="text-center">And Click "Quote Request"</p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="my-4">
                <fieldset class="border-2">
                    <legend class="mx-4 px-2 text-xl font-bold"><h2>STEP 3 - MAKE PAYMENT</h2></legend>
                    <div class="px-8 py-4 grid grid-cols-2 gap-8">
                        <div class="flex flex-col justify-center items-center gap-4">
                            <div>
                                <img src="{{ asset('images/buy/s5.png') }}" alt="s5">
                            </div>
                            <div>
                                <p class="text-center">-BANK WIRE TRANSFER (TELEGRAPHIC TRANSFER) ALL CUSTOMER SHOULD SEND MONEY ONLY TO SGASIACARS CO,LTD. BENEFICIARY ACCOUNTS IN JAPAN</p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center gap-4">
                            <div>
                                <img src="{{ asset('images/buy/s6.png') }}" alt="s6">
                            </div>
                            <div>
                                <p class="text-center">PayPal PAYMENT ASK YOUR SALES REPRESENTATIVE TO GET INVOICE FOR ONLY PAYPAL THEN YOU WILL GET PAYPAL ACCOUNT ADDRESS</p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="my-4">
                <fieldset class="border-2">
                    <legend class="mx-4 px-2 text-xl font-bold"><h2>STEP 4 - SHIPMENT</h2></legend>
                    <div class="px-8 py-4 grid grid-cols-2 gap-8">
                        <div class="flex flex-col justify-center items-center gap-4">
                            <div>
                                <img src="{{ asset('images/buy/s7.png') }}" alt="s7">
                            </div>
                            <div>
                                <p class="text-center"></p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center gap-4">
                            <div>
                                <img src="{{ asset('images/buy/s8.png') }}" alt="s8">
                            </div>
                            <div>
                                <p class="text-center"></p>
                            </div>
                        </div>
                    </div>
                    <p class="text-center">TRACK YOUR SHIPMENT</p>
                </fieldset>
            </div>

            <div class="my-4">
                <fieldset class="border-2">
                    <legend class="mx-4 px-2 text-xl font-bold"><h2>STEP 5 - CUSTOM CLEARANCE</h2></legend>
                    <div class="px-8 py-4 grid grid-cols-2 gap-8">
                        <div class="flex flex-col justify-center items-center gap-4">
                            <div>
                                <img src="{{ asset('images/buy/s9.png') }}" alt="s9">
                            </div>
                            <div>
                                <p class="text-center"></p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center gap-4">
                            <div>
                                <img src="{{ asset('images/buy/s10.png') }}" alt="s10">
                            </div>
                            <div>
                                <p class="text-center"></p>
                            </div>
                        </div>
                    </div>
                    <p class="text-center">COMPLETE CUSTOM CLEARANCE</p>
                </fieldset>
            </div>
        </div>
    </div>
    {{-- contact information --}}
    @include('includes.contact-info')
@endsection
