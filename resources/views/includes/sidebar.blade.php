@push('style')
<link rel="stylesheet" href="{{ asset('css/jquery.range.css') }}">
@endpush
{{-- shop by make --}}
<div class="mb-4">
    <h1 class="py-2 px-2 dark-blue-bg text-white text-center text-sm font-bold">SHOP BY MAKE</h1>
    <div class="flex flex-col gap-2 mt-2 divide-y divide-solid divide-gray">
        <a href="{{ route('landing.stocklist', ['maker' => '1']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/toyota-car-logo-6968.png') }}" width="25px" alt="logo"> TOYOTA</a>
        <a href="{{ route('landing.stocklist', ['maker' => '8']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/nissan-logo-703.png') }}" width="25px" alt="logo"> NISSAN</a>
        <a href="{{ route('landing.stocklist', ['maker' => '21']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/Isuzu-logo-1991-3840x2160.png') }}" width="25px" alt="logo"> ISUZU</a>
        <a href="{{ route('landing.stocklist', ['maker' => '5']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/mitsubishi-logo.png') }}" width="25px" alt="logo"> MITSUBISHI</a>
        <a href="{{ route('landing.stocklist', ['maker' => '9']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/Ford-Motor-Company-Logo.png') }}" width="25px" alt="logo"> FORD</a>
        <a href="{{ route('landing.stocklist', ['maker' => '33']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/chevrolet-logo.png') }}" width="25px" alt="logo"> CHEVERLOT</a>
        {{-- <a href="#" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/mazda_PNG86.png') }}" width="25px" alt="logo"> MAZDA</a> --}}
    </div>
</div>

{{-- shop by price --}}
<form action="{{ route('landing.stocklist') }}" class="mb-4">
    <h1 class="py-2 px-2 dark-blue-bg text-white text-center text-sm font-bold">SHOP BY PRICE</h1>
    <div class="flex justify-center my-6">
        <input type="hidden" class="range-slider border" value="0" />
    </div>
    <div class="grid grid-cols-12">
        <input type="number" placeholder="Min" name="min_price" id="min_price" class="col-span-5 w-full border-blue-900 rounded h-6 text-sm" >
        <p class="col-span-2 text-center text-sm text-gray-500">To</p>
        <input type="number" placeholder="Max" name="max_price" id="max_price" class="col-span-5 w-full border-blue-900 rounded h-6 text-sm" >
    </div>
    <input type="submit" class="hidden">
</form>

{{-- shop by type --}}
<div class="mb-4">
    <h1 class="py-2 px-2 dark-blue-bg text-white text-center text-sm font-bold">SHOP BY TYPE</h1>
    <div class="flex flex-col gap-2 mt-2 divide-y divide-solid divide-gray">
        <a href="{{ route('landing.stocklist', ['type' => '19']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/toyota-car-logo-6968.png') }}" width="25px" alt="logo"> SINGLE CAB</a>
        <a href="{{ route('landing.stocklist', ['type' => '18']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/toyota-car-logo-6968.png') }}" width="25px" alt="logo"> DOUBLE CAB</a>
        <a href="{{ route('landing.stocklist', ['type' => '20']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/toyota-car-logo-6968.png') }}" width="25px" alt="logo"> SMART CAB</a>
        <a href="{{ route('landing.stocklist', ['type' => '8']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/toyota-car-logo-6968.png') }}" width="25px" alt="logo"> PICK UP</a>
        <a href="{{ route('landing.stocklist', ['type' => '6']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/toyota-car-logo-6968.png') }}" width="25px" alt="logo"> SEDAN</a>
        <a href="{{ route('landing.stocklist', ['type' => '5']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/suv.png') }}" width="25px" alt="logo"> SUV</a>
        <a href="{{ route('landing.stocklist', ['type' => '11']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/toyota-car-logo-6968.png') }}" width="25px" alt="logo"> VAN</a>
    </div>
</div>

{{-- other categories --}}
<div class="mb-4">
    <h1 class="py-2 px-2 dark-blue-bg text-white text-center text-sm font-bold">OTHER CATEGORIES</h1>
    <div class="flex flex-col gap-2 mt-2 divide-y divide-solid divide-gray">
        <a href="{{ route('landing.stocklist', ['fuel' => 'petrol']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/toyota-car-logo-6968.png') }}" width="25px" alt="logo"> PETROL</a>
        <a href="{{ route('landing.stocklist', ['fuel' => 'hybrid(petrol)']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/toyota-car-logo-6968.png') }}" width="25px" alt="logo"> HYBRID(PETROL)</a>
        <a href="{{ route('landing.stocklist', ['fuel' => 'diesel']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/assets/nissan-logo-703.png') }}" width="25px" alt="logo"> DIESEL</a>
    </div>
</div>

{{-- vehicles in stock --}}
<div class="mb-4">
    <h1 class="py-2 px-2 dark-blue-bg text-white text-center text-sm font-bold">VEHICLES IN STOCK</h1>
    <div class="flex flex-col gap-2 mt-2 divide-y divide-solid divide-gray">
        <a href="{{ route('landing.stocklist', ['stock_country' => '213']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/flags/thailand.png') }}" width="25px" alt="logo"> THAILAND</a>
        <a href="{{ route('landing.stocklist', ['stock_country' => '225']) }}" class="flex gap-3 items-center"> <img src="{{ asset('images/flags/united-arab-emirates.png') }}" width="25px" alt="logo"> UAE</a>
        {{-- <a href="{{ route('landing.stocklist') }}" class="flex gap-3 items-center"> <img src="{{ asset('images/nissan.png') }}" width="25px" alt="logo"> OTHER</a> --}}
    </div>
</div>

<div class="mb-4">
    <a href="#">
        <img src="{{ asset('images/stocks/dubai.jpg') }}" alt="stock_banner">
    </a>
</div>

{{-- <div class="mb-4">
    <a href="{{ route('landing.stocklist') }}">
        <img src="https://via.placeholder.com/186x433.png">
    </a>
</div> --}}


@push('js')
<script src="{{ asset('js/jquery.range-min.js') }}"></script>
<script>
    $('.range-slider').jRange({
        from: 0,
        to: 50000,
        step: 1000,
        scale: [0,50000],
        format: 'USD %s',
        width: 150,
        showLabels: true,
        isRange : true,
        onstatechange: function(){
            var vals = $('.range-slider').val();
            var avals = vals.split(',')
            var min = avals[0];
            var max = avals[1];

            $('#min_price').val(min);
            $('#max_price').val(max);
        }
    });
</script>
@endpush
