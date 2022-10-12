@php
    $productsCount = \App\Models\Product::count();

    $today = \Carbon\Carbon::today();
    // dd($today);
    $newProductsCountToday = \App\Models\Product::whereDate('created_at', '=', $today->toDateString())->count();
@endphp
<section class="dark-blue-bg d-none d-sm-block">
    <div class="container">
      <div class="row" style="align-items: center;">
        <div class="col">
          <p href="#" class="text-white text-sm"><a href="{{ route('landing.stocklist') }}" class="text-white">Total
              Cars In Stock: {{ $productsCount ?? 0 }}</a></p>
        </div>
        <div class="col">
          <p href="#" class="text-white text-sm"><a href="{{ route('landing.stocklist', ['date_from' => ''.\Carbon\Carbon::today()->toDateString().'']) }}"
              class="text-white">Cars Added Today: 0</a></p>
        </div>
        <div class="col">
          <p href="#" class="text-white text-sm">Thailand Time: {{now()->format('H : i ')}}</p>
        </div>
        <div class="col">
          <p href="#" class="text-white text-sm">Contact: <a href="tel:+66 91 786 9096" class="text-white">66 97 971 4637</a></p>
        </div>
        <div class="col">
          <select name="lang" class="py-0 bg-white  d-sm-none d-md-block">
            <option value="eng">English</option>
            <option value="fre">French</option>
          </select>
        </div>
      </div>
    </div>
  </section>
