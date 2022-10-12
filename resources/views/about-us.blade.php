@extends('layouts.main')
@push('title')
    <title> {{$pagedata->seo_title}}</title>
@endpush
@push('meta')
<meta name="description" content="{{ $pagedata->meta_description? $pagedata->meta_description: "" }}">
<meta name="keywords" content="{{ $pagedata->meta_keywords? $pagedata->meta_keywords: "" }}">
@endpush
@section('content')
    <div class="w-10/12 mx-auto my-4">
        <div class="bg-blue-100 rounded-md p-4">
            <h1 class="text-2xl font-bold text-center dark-blue-text">We Are (Company)</h1>
            <hr class="border-blue-900">
            <div class="grid grid-cols-1 mt-4 gap-y-4">
                <div>
                    <p class="text-sm">Thailand’s used car export company. We are specialized in export of used commercial trucks, pickup Toyota REVO (Toyota hilux), vans and minibus from Thailand. We do not just supply used Hilux for sale, but also our service including 100% outgoing inspection of your selected used cars and export car accessories and car parts. We can supply cars with such car modifications and conversions as being van car with VIP seats and lighted roofing with audio seats, We have many cars on our stock including commercial trucks such as Toyota Hilux Vigo, Hilux champ, Toyota Fortuner. Largest stock of Used Toyota hilux vigo double cab, Hilux Single cab, Extra cab, Smart cab 4wd, Toyota Revo, Toyota hilux revo. Fully loaded hilux only SG Cars Asia, One stop service. Toyota hilux vigo exporter.</p>
                    <h1 class="mt-3 text-lg">We one of the fastest growing independent car sales businesses in the county. With over 10 year’s experience, we are committed to providing you with the highest levels of customer service as described below:</h1>
                </div>

                <div>
                    <h2 class="text-xl font-bold dark-blue-text">1. Communication</h2>
                    <p class="text-sm">Making it as easy as possible to contact us 7 days a week by phone or by e-mail.(+66 80 806 6007 +66 84 344 3444 viber,Whatsapp,Line)</p>
                </div>

                <div>
                    <h2 class="text-xl font-bold dark-blue-text">2. Accuracy</h2>
                    <p class="text-sm">Providing clear, complete and accurate information on our products, services and pricing either by phone, email or post. Explaining all points of our sales and service procedures to you at all times.Quoting on any additional work that should be carried out or should become required in the near future immediately it becomes apparent.</p>
                </div>

                <div>
                    <h2 class="text-xl font-bold dark-blue-text">3. Performance</h2>
                    <p class="text-sm">Ensuring that in every aspect of our work, each individual is responsible and accountable for the quality of their work.Continuously enhancing and improving the services and technology in place within the Company to meet and exceed the expectations of our customers.Working with our customers to correct any problem and taking action to ensure that the problem does not recur.</p>
                </div>

                <div>
                    <h2 class="text-xl font-bold dark-blue-text">4. Honesty and Integrity</h2>
                    <p class="text-sm">At all times striving to be honest, friendly and courteous, treating all customers as valued customers.Making certain that should the level of service we provide fail to meet your reasonable expectations, we take steps to rectify the situation, as soon as it is brought to our attention. In the event that you are not happy with the resolution provided, we will endeavor to escalate and resolve the issue within the relevant department. Treating your personal information in the strictest confidence.Ensuring that details of your transactions with the Company are discussed only with you or your authorized representative.</p>
                </div>

                <div class="dark-blue-text">
                    <p class="text-sm">For more detail call (viber and Whatsapp)</p>
                    <p class="text-sm">Head Office +66 930044903</p>
                    <p class="text-sm">BANGKOK/NONG KHAM +66 631655501-9</p>
                    <p class="text-sm">CHIANG MAI +66 932387148</p>
                    <p class="text-sm">BANGKOK/SRINAKARIN +66 631655501-9</p>
                    <p class="text-sm">PATTAYA +66 631655501-9</p>
                    <p class="text-sm">Thailand +66 80 806 6007</p>
                    <p class="text-sm">Thailand +66 92 982 4192</p>
                    <p class="text-sm">Thailand +66 95 848 4842</p>
                    <p class="text-sm">Thailand +66 80 080 5793</p>
                    <p class="text-sm">Myanmar +66 85 562 8779</p>
                    <p class="text-sm">Srilanka +94 77 777 4688</p>
                    <p class="text-sm">Saint lucia +1 758 730 4152</p>
                </div>
            </div>
        </div>
    </div>
    @include('includes.contact-info')
@endsection
