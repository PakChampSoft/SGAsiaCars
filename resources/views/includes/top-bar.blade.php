@php
    $productsCount = \App\Models\Product::count();

    $today = \Carbon\Carbon::today();
    // dd($today);
    $newProductsCountToday = \App\Models\Product::whereDate('created_at', '=', $today->toDateString())->count();
@endphp
<div class="dark-blue-bg">
    <div class="flex items-center justify-between top-bar-container">
        <p href="#" class="text-white text-sm"><a href="{{ route('landing.stocklist') }}">Total Cars In Stock: {{ $productsCount ?? 0 }}</a></p>
        <p href="#" class="text-white text-sm"><a href="{{ route('landing.stocklist', ['date_from' => ''.\Carbon\Carbon::today()->toDateString().'']) }}">Cars Added Today: {{ $newProductsCountToday ?? 0 }}</a></p>
        {{-- <p href="#" class="text-white text-sm"><a href="{{ route('landing.stocklist', ['date_from' => '2021-12-07']) }}">Cars Added Today: {{ $newProductsCountToday ?? 0 }}</a></p> --}}
        <p href="#" class="text-white text-sm">Thailand Time: {{now()->format('H : i ')}}</p>
        <p href="#" class="text-white text-sm">Contact: <a href="tel:+66 91 786 9096">+66 91 786 9096</a> , <a href="tel:+66 89 757 8551">+66 89 757 8551</a></p>
        <select name="lang" class="py-0 bg-white">
            <option value="eng">English</option>
            <option value="fre">French</option>
        </select>
    </div>
</div>
