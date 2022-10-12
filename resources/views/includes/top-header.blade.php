<div class="py-4 gray-box shadow">
    <div class="grid grid-cols-12 top-header-container">
        <div class="col-span-3">
            {{-- <a href="{{ route('landing.index') }}" class="text-3xl font-bold blue-text">BRAND LOGO</a> --}}
            <a href="{{ route('landing.index') }}" class="text-3xl font-bold blue-text">
                <img src="{{ asset('images/SG logo.png') }}" alt="logo">
            </a>
        </div>
        <div id="search" class="col-span-6">
            <form action="{{ route('landing.full_text') }}" class="flex items-center justify-start">
                <input type="text" value="{{ request()->qry }}" name="qry" placeholder="Search Vehicle" class="w-full rounded-l-md border-blue-700 border-2 py-1">
                <input type="submit" class="text-white dark-blue-bg rounded-r-lg px-4 py-1 border-2 border-blue-700 cursor-pointer" value="Search">
            </form>
        </div>
    </div>
</div>
