<div id="search-by-maker">
    <h1 class="py-2 px-2 dark-blue-bg text-white text-center text-sm font-bold">SHOP BY MAKE</h1>
    <div class="flex flex-col gap-2 mt-2 divide-y divide-solid">
        <a href="{{ route('landing.stocklist', ['maker' => '1']) }}"
            class="flex gap-3 items-center border-bottom-gray text-dark-black"> <img
                src="{{ asset('assets/images/toyota-car-logo-6968.png') }}" width="25px" alt="logo">
            TOYOTA <small>({{ session('toyota') }})</small>
        </a>
        <a href="{{ route('landing.stocklist', ['maker' => '8']) }}" class="flex gap-3 items-center border-bottom-gray text-dark-black"> <img
                src="{{ asset('assets/images/nissan-logo-703.png') }}" width="25px" alt="logo"> NISSAN <small>({{ session('nissan') }})</small></a>
        <a href="{{ route('landing.stocklist', ['maker' => '21']) }}" class="flex gap-3 items-center border-bottom-gray text-dark-black"> <img
                src="assets/images/Isuzu-logo-1991-3840x2160.png" width="25px" alt="logo">
            ISUZU <small>({{ session('ISUZU') }})</small></a>
        <a href="{{ route('landing.stocklist', ['maker' => '5']) }}" class="flex gap-3 items-center border-bottom-gray text-dark-black"> <img
                src="{{ asset('assets/images/mitsubishi-logo.png') }}" width="25px" alt="logo"> MITSUBISHI <small>({{ session('MITSUBISHI') }})</small></a>
        <a href="{{ route('landing.stocklist', ['maker' => '9']) }}" class="flex gap-3 items-center border-bottom-gray text-dark-black"> <img
                src="assets/images/Ford-Motor-Company-Logo.png" width="25px" alt="logo">
            FORD <small>({{ session('FORD') }})</small></a>
        <a href="{{ route('landing.stocklist', ['maker' => '33']) }}" class="flex gap-3 items-center border-bottom-gray text-dark-black"> <img
                src="{{ asset('assets/images/chevrolet-logo.png') }}" width="25px" alt="logo"> CHEVERLOT <small>({{ session('CHEVROLET') }})</small></a>

    </div>
    <div id="search-by-price-range">
        <form action="{{ route('landing.stocklist') }}" class="mb-4">
            <h1 class="py-2 px-2 dark-blue-bg text-white text-center text-sm font-bold mb-20">SHOP BY PRICE</h1>
            <div class="flex justify-center my-6 mb-20">
                <input type="hidden" class="range-slider border" value="0" />
            </div>
            <div class="row">
                <div class="col-md-6" style="display: inline-flex;">
                    <input type="number" placeholder="Min" name="min_price" id="min_price"
                        class="border-blue-900 rounded h-6 text-sm price-range-input-width">
                    <p class="text-center text-sm text-gray-500 padding-3">To</p>
                </div>
                <div class="col-md-6">
                    <input type="number" placeholder="Max" name="max_price" id="max_price"
                        class="border-blue-900 rounded h-6 text-sm price-range-input-width">
                </div>

            </div>
            <input type="submit" class="hidden">
        </form>
    </div>
    <div id="search-by-type">
        <div class="mb-4">
            <h1 class="py-2 px-2 dark-blue-bg text-white text-center text-sm font-bold">SHOP BY TYPE</h1>
            <div class="flex flex-col gap-2 mt-2 divide-y divide-solid divide-gray">
                <a href="{{ route('landing.stocklist', ['type' => '19']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/dblcab.png') }}"
                        width="25px" alt="logo">
                    SINGLE CAB <small>({{ session('SINGLE_CAB') }})</small></a>
                <a href="{{ route('landing.stocklist', ['type' => '18']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/suv.png') }}"
                        width="25px" alt="logo">
                    DBL CAB <small>({{ session('DOUBLE_CAB') }})</small></a>
                <a href="{{ route('landing.stocklist', ['type' => '20']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/smartcab.png') }}"
                        width="25px" alt="logo"> SMART CAB <small>({{ session('SMART_CAB') }})</small></a>
                <a href="{{ route('landing.stocklist', ['type' => '8']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/van.png') }}"
                        width="25px" alt="logo">
                    PICK UP <small>({{ session('PICK_UP') }})</small></a>
                <a href="{{ route('landing.stocklist', ['type' => '6']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/pickup.png') }}"
                        width="25px" alt="logo">
                    SEDAN <small>({{ session('SEDAN') }})</small></a>
                <a href="{{ route('landing.stocklist', ['type' => '5']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/suv.png') }}"
                        width="25px" alt="logo">
                    SUV <small>({{ session('SUV') }})</small></a>
                <a href="{{ route('landing.stocklist', ['type' => '11']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/van.png') }}"
                        width="25px" alt="logo">
                    VAN <small>({{ session('VAN') }})</small></a>
            </div>
        </div>
    </div>
    <div id="search-by-categories">
        <div class="mb-4">
            <h1 class="py-2 px-2 dark-blue-bg text-white text-center text-sm font-bold">OTHER CATEGORIES</h1>
            <div class="flex flex-col gap-2 mt-2 divide-y divide-solid divide-gray">
                <a href="{{ route('landing.stocklist', ['fuel' => 'petrol']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/petrol.png') }}"
                        width="25px" alt="logo"> PETROL <small>({{ session('Petrol') }})</small></a>
                <a href="{{ route('landing.stocklist', ['fuel' => 'hybrid(petrol)']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/hybpetrol.png') }}"
                        width="25px" alt="logo">
                    HYBRID <small>({{ session('Hybrid') }})</small></a>
                <a href="{{ route('landing.stocklist', ['fuel' => 'diesel']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/diesel.png') }}"
                        width="25px" alt="logo"> DIESEL <small>({{ session('Diesel') }})</small></a>
            </div>
        </div>
    </div>
    <div id="search-by-countries">
        <div class="mb-4">
            <h1 class="py-2 px-2 dark-blue-bg text-white text-center text-sm font-bold">VEHICLES IN STOCK</h1>
            <div class="flex flex-col gap-2 mt-2 divide-y divide-solid divide-gray">
                <a href="{{ route('landing.stocklist', ['stock_country' => '213']) }}" class="flex gap-3 items-center text-dark-black"> <img src="{{ asset('assets/images/thailand.png') }}"
                        width="25px" alt="logo"> THAILAND <small>({{ session('THAILAND') }})</small></a>
                <a href="{{ route('landing.stocklist', ['stock_country' => '225']) }}" class="flex gap-3 items-center text-dark-black"> <img
                        src="{{ asset('assets/images/united-arab-emirates.png') }}" width="25px" alt="logo"> UAE <small>({{ session('UAE') }})</small></a>
            </div>
        </div>
    </div>
</div>
