<div class="w-full gray-box shadow-lg">
    <h1 class="dark-blue-bg py-1 text-white text-sm text-center font-bold">
        <a href="#" class="text-xs px-1">CREATE ACCOUNT<i class="las la-user text-lg"></i></a>
    </h1>
    <form action="#" class="flex flex-col gap-2 mt-4 px-2">
        <input type="text" placeholder="YOUR NAME" class="gray-box px-0 signup-input">
        <input type="text" placeholder="YOUR EMAIL" class="gray-box px-0 signup-input">
        <input type="text" placeholder="YOUR PHONE" class="gray-box px-0 signup-input">
        <select name="user_country" class="gray-box px-0 signup-input" id="user_country">
            <option value="" disabled selected>Country</option>
            @forelse (session('countries') as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @empty
                <option value="" disabled>No Countries Found</option>
            @endforelse
        </select>
        <div class="w-full mt-4 flex justify-center">
            <input type="submit" value="LOGIN" class="dark-blue-bg text-white px-6 border-0">
        </div>

    </form>
    <div class="w-full mt-8">
        <div class="w-full h-full text-center">
            <h1 class="dark-blue-text text-sm text-center">Shipping Scheduling</h1>
            <a href="{{ asset('docs/schdule.pdf') }}" target="_blank">
                <img src="{{ asset('assets/images/shipping.png') }}" class="w-full-schedule h-auto" alt="shipping">
            </a>
        </div>
    </div>
</div>


